<?php
namespace Everyman\Neo4j\Command;
use Everyman\Neo4j\Command,
	Everyman\Neo4j\Exception,
	Everyman\Neo4j\Node;

/**
 * Delete a node
 */
class DeleteNode implements Command
{
	protected $node = null;

	/**
	 * Set the node to drive the command
	 *
	 * @param Node $node
	 */
	public function __construct(Node $node)
	{
		$this->node = $node;
	}

	/**
	 * Return the data to pass
	 *
	 * @return mixed
	 */
	public function getData()
	{
		return null;
	}

	/**
	 * Return the transport method to call
	 *
	 * @return string
	 */
	public function getMethod()
	{
		return 'delete';
	}

	/**
	 * Return the path to use
	 *
	 * @return string
	 */
	public function getPath()
	{
		if (!$this->node->getId()) {
			throw new Exception('No node id specified for delete');
		}
		return '/node/'.$this->node->getId();
	}

	/**
	 * Use the results
	 *
	 * @param integer $code
	 * @param array   $headers
	 * @param array   $data
	 * @return integer on failure
	 */
	public function handleResult($code, $headers, $data)
	{
		if ((int)($code / 100) == 2) {
			return null;
		}
		return $code;
	}
}

