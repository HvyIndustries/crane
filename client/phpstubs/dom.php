<?php

// Start of dom v.20031129

/**
 * DOM operations raise exceptions under particular circumstances, i.e.,
 * when an operation is impossible to perform for logical reasons.
 * @link http://php.net/manual/en/class.domexception.php
 */
class DOMException extends Exception  {
	protected $message;
	protected $file;
	protected $line;
	public $code;


	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Clone the exception
	 * @link http://php.net/manual/en/exception.clone.php
	 * @return void No value is returned.
	 */
	final private function __clone () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Construct the exception
	 * @link http://php.net/manual/en/exception.construct.php
	 * @param string $message [optional] <p>
	 * The Exception message to throw.
	 * </p>
	 * @param int $code [optional] <p>
	 * The Exception code.
	 * </p>
	 * @param Exception $previous [optional] <p>
	 * The previous exception used for the exception chaining.
	 * </p>
	 */
	public function __construct ($message = "", $code = 0, Exception $previous = null) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception message
	 * @link http://php.net/manual/en/exception.getmessage.php
	 * @return string the Exception message as a string.
	 */
	final public function getMessage () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the Exception code
	 * @link http://php.net/manual/en/exception.getcode.php
	 * @return mixed the exception code as integer in
	 * <b>Exception</b> but possibly as other type in
	 * <b>Exception</b> descendants (for example as
	 * string in <b>PDOException</b>).
	 */
	final public function getCode () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the file in which the exception occurred
	 * @link http://php.net/manual/en/exception.getfile.php
	 * @return string the filename in which the exception was created.
	 */
	final public function getFile () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the line in which the exception occurred
	 * @link http://php.net/manual/en/exception.getline.php
	 * @return int the line number where the exception was created.
	 */
	final public function getLine () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace
	 * @link http://php.net/manual/en/exception.gettrace.php
	 * @return array the Exception stack trace as an array.
	 */
	final public function getTrace () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Returns previous Exception
	 * @link http://php.net/manual/en/exception.getprevious.php
	 * @return Exception the previous <b>Exception</b> if available
	 * or <b>NULL</b> otherwise.
	 */
	final public function getPrevious () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Gets the stack trace as a string
	 * @link http://php.net/manual/en/exception.gettraceasstring.php
	 * @return string the Exception stack trace as a string.
	 */
	final public function getTraceAsString () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * String representation of the exception
	 * @link http://php.net/manual/en/exception.tostring.php
	 * @return string the string representation of the exception.
	 */
	public function __toString () {}

}

class DOMStringList  {

	/**
	 * @param $index
	 */
	public function item ($index) {}

}

/**
 * @link http://php.net/manual/en/book.dom.php
 */
class DOMNameList  {

	/**
	 * @param $index
	 */
	public function getName ($index) {}

	/**
	 * @param $index
	 */
	public function getNamespaceURI ($index) {}

}

class DOMImplementationList  {

	/**
	 * @param $index
	 */
	public function item ($index) {}

}

class DOMImplementationSource  {

	/**
	 * @param $features
	 */
	public function getDomimplementation ($features) {}

	/**
	 * @param $features
	 */
	public function getDomimplementations ($features) {}

}

/**
 * The <b>DOMImplementation</b> interface provides a number
 * of methods for performing operations that are independent of any
 * particular instance of the document object model.
 * @link http://php.net/manual/en/class.domimplementation.php
 */
class DOMImplementation  {

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Test if the DOM implementation implements a specific feature
	 * @link http://php.net/manual/en/domimplementation.hasfeature.php
	 * @param string $feature <p>
	 * The feature to test.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test. In
	 * level 2, this can be either 2.0 or
	 * 1.0.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasFeature ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Creates an empty DOMDocumentType object
	 * @link http://php.net/manual/en/domimplementation.createdocumenttype.php
	 * @param string $qualifiedName [optional] <p>
	 * The qualified name of the document type to create.
	 * </p>
	 * @param string $publicId [optional] <p>
	 * The external subset public identifier.
	 * </p>
	 * @param string $systemId [optional] <p>
	 * The external subset system identifier.
	 * </p>
	 * @return DOMDocumentType A new <b>DOMDocumentType</b> node with its
	 * ownerDocument set to <b>NULL</b>.
	 */
	public function createDocumentType ($qualifiedName = null, $publicId = null, $systemId = null) {}

	/**
	 * (PHP 5)<br/>
	 * Creates a DOMDocument object of the specified type with its document element
	 * @link http://php.net/manual/en/domimplementation.createdocument.php
	 * @param string $namespaceURI [optional] <p>
	 * The namespace URI of the document element to create.
	 * </p>
	 * @param string $qualifiedName [optional] <p>
	 * The qualified name of the document element to create.
	 * </p>
	 * @param DOMDocumentType $doctype [optional] <p>
	 * The type of document to create or <b>NULL</b>.
	 * </p>
	 * @return DOMDocument A new <b>DOMDocument</b> object. If
	 * <i>namespaceURI</i>, <i>qualifiedName</i>,
	 * and <i>doctype</i> are null, the returned
	 * <b>DOMDocument</b> is empty with no document element
	 */
	public function createDocument ($namespaceURI = null, $qualifiedName = null, DOMDocumentType $doctype = null) {}

}

/**
 * @link http://php.net/manual/en/class.domnode.php
 */
class DOMNode  {
	/**
	 * <p style="margin-top:0;">Returns the most accurate name for the current node type</p>
	 * @var string
	 */
	public $nodeName;
	/**
	 * <p style="margin-top:0;">The value of this node, depending on its type</p>
	 * @var string
	 */
	public $nodeValue;
	/**
	 * <p style="margin-top:0;">Gets the type of the node. One of the predefined <b>XML_xxx_NODE constants</b></p>
	 * @var int
	 */
	public $nodeType;
	/**
	 * <p style="margin-top:0;">The parent of this node. If there is no such node, this returns <b><code>NULL</code></b>.</p>
	 * @var DOMNode
	 */
	public $parentNode;
	/**
	 * <p style="margin-top:0;">
	 * A <b>DOMNodeList</b> that contains all
	 * children of this node. If there are no children, this is an empty
	 * <b>DOMNodeList</b>.
	 * </p>
	 * @var DOMNodeList
	 */
	public $childNodes;
	/**
	 * <p style="margin-top:0;">
	 * The first child of this node. If there is no such node, this
	 * returns <b><code>NULL</code></b>.
	 * </p>
	 * @var DOMNode
	 */
	public $firstChild;
	/**
	 * <p style="margin-top:0;">The last child of this node. If there is no such node, this returns <b><code>NULL</code></b>.</p>
	 * @var DOMNode
	 */
	public $lastChild;
	/**
	 * <p style="margin-top:0;">
	 * The node immediately preceding this node. If there is no such
	 * node, this returns <b><code>NULL</code></b>.
	 * </p>
	 * @var DOMNode
	 */
	public $previousSibling;
	/**
	 * <p style="margin-top:0;">
	 * The node immediately following this node. If there is no such
	 * node, this returns <b><code>NULL</code></b>.
	 * </p>
	 * @var DOMNode
	 */
	public $nextSibling;
	/**
	 * <p style="margin-top:0;">
	 * A <b>DOMNamedNodeMap</b> containing the
	 * attributes of this node (if it is a <b>DOMElement</b>)
	 * or <b><code>NULL</code></b> otherwise.
	 * </p>
	 * @var DOMNamedNodeMap
	 */
	public $attributes;
	/**
	 * <p style="margin-top:0;">The <b>DOMDocument</b> object associated with this node.</p>
	 * @var DOMDocument
	 */
	public $ownerDocument;
	/**
	 * <p style="margin-top:0;">The namespace URI of this node, or <b><code>NULL</code></b> if it is unspecified.</p>
	 * @var string
	 */
	public $namespaceURI;
	/**
	 * <p style="margin-top:0;">The namespace prefix of this node, or <b><code>NULL</code></b> if it is unspecified.</p>
	 * @var string
	 */
	public $prefix;
	/**
	 * <p style="margin-top:0;">Returns the local part of the qualified name of this node.</p>
	 * @var string
	 */
	public $localName;
	/**
	 * <p style="margin-top:0;">
	 * The absolute base URI of this node or <b><code>NULL</code></b> if the implementation
	 * wasn't able to obtain an absolute URI.
	 * </p>
	 * @var string
	 */
	public $baseURI;
	/**
	 * <p style="margin-top:0;">The text content of this node and its descendants.</p>
	 * @var string
	 */
	public $textContent;


	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

class DOMNameSpaceNode  {
}

/**
 * @link http://php.net/manual/en/class.domdocumentfragment.php
 */
class DOMDocumentFragment extends DOMNode  {

	public function __construct () {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Append raw XML data
	 * @link http://php.net/manual/en/domdocumentfragment.appendxml.php
	 * @param string $data <p>
	 * XML to append.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function appendXML ($data) {}

	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

/**
 * Represents an entire HTML or XML document; serves as the root of the
 * document tree.
 * @link http://php.net/manual/en/class.domdocument.php
 */
class DOMDocument extends DOMNode  {
	/**
	 * <p style="margin-top:0;">
	 * Deprecated. Actual encoding of the document,
	 * is a readonly equivalent to
	 * encoding.
	 * </p>
	 * @var string
	 */
	public $actualEncoding;
	/**
	 * <p style="margin-top:0;">
	 * Deprecated. Configuration used when
	 * <b>DOMDocument::normalizeDocument()</b> is
	 * invoked.
	 * </p>
	 * @var DOMConfiguration
	 */
	public $config;
	/**
	 * <p style="margin-top:0;">The Document Type Declaration associated with this document.</p>
	 * @var DOMDocumentType
	 */
	public $doctype;
	/**
	 * <p style="margin-top:0;">
	 * This is a convenience attribute that allows direct access to the
	 * child node that is the document element of the document.
	 * </p>
	 * @var DOMElement
	 */
	public $documentElement;
	/**
	 * <p style="margin-top:0;">The location of the document or <b><code>NULL</code></b> if undefined.</p>
	 * @var string
	 */
	public $documentURI;
	/**
	 * <p style="margin-top:0;">
	 * Encoding of the document, as specified by the XML declaration. This
	 * attribute is not present in the final DOM Level 3 specification, but
	 * is the only way of manipulating XML document encoding in this
	 * implementation.
	 * </p>
	 * @var string
	 */
	public $encoding;
	/**
	 * <p style="margin-top:0;">Nicely formats output with indentation and extra space.</p>
	 * @var bool
	 */
	public $formatOutput;
	/**
	 * <p style="margin-top:0;">
	 * The <b>DOMImplementation</b> object that handles
	 * this document.
	 * </p>
	 * @var DOMImplementation
	 */
	public $implementation;
	/**
	 * <p style="margin-top:0;">Do not remove redundant white space. Default to <b><code>TRUE</code></b>.</p>
	 * @var bool
	 */
	public $preserveWhiteSpace;
	/**
	 * <p style="margin-top:0;">
	 * Proprietary. Enables recovery mode, i.e. trying
	 * to parse non-well formed documents. This attribute is not part of
	 * the DOM specification and is specific to libxml.
	 * </p>
	 * @var bool
	 */
	public $recover;
	/**
	 * <p style="margin-top:0;">
	 * Set it to <b><code>TRUE</code></b> to load external entities from a doctype
	 * declaration. This is useful for including character entities in
	 * your XML document.
	 * </p>
	 * @var bool
	 */
	public $resolveExternals;
	/**
	 * <p style="margin-top:0;">
	 * Deprecated. Whether or not the document is
	 * standalone, as specified by the XML declaration, corresponds to
	 * xmlStandalone.
	 * </p>
	 * @var bool
	 */
	public $standalone;
	/**
	 * <p style="margin-top:0;">Throws <b>DOMException</b> on errors. Default to <b><code>TRUE</code></b>.</p>
	 * @var bool
	 */
	public $strictErrorChecking;
	/**
	 * <p style="margin-top:0;">
	 * Proprietary. Whether or not to substitute
	 * entities. This attribute is not part of
	 * the DOM specification and is specific to libxml.
	 * </p>
	 * @var bool
	 */
	public $substituteEntities;
	/**
	 * <p style="margin-top:0;">Loads and validates against the DTD. Default to <b><code>FALSE</code></b>.</p>
	 * @var bool
	 */
	public $validateOnParse;
	/**
	 * <p style="margin-top:0;">
	 * Deprecated. Version of XML, corresponds to
	 * xmlVersion.
	 * </p>
	 * @var string
	 */
	public $version;
	/**
	 * <p style="margin-top:0;">
	 * An attribute specifying, as part of the XML declaration, the
	 * encoding of this document. This is <b><code>NULL</code></b> when unspecified or when it
	 * is not known, such as when the Document was created in memory.
	 * </p>
	 * @var string
	 */
	public $xmlEncoding;
	/**
	 * <p style="margin-top:0;">
	 * An attribute specifying, as part of the XML declaration, whether
	 * this document is standalone. This is <b><code>FALSE</code></b> when unspecified.
	 * </p>
	 * @var bool
	 */
	public $xmlStandalone;
	/**
	 * <p style="margin-top:0;">
	 * An attribute specifying, as part of the XML declaration, the
	 * version number of this document. If there is no declaration and if
	 * this document supports the "XML" feature, the value is "1.0".
	 * </p>
	 * @var string
	 */
	public $xmlVersion;


	/**
	 * (PHP 5)<br/>
	 * Create new element node
	 * @link http://php.net/manual/en/domdocument.createelement.php
	 * @param string $name <p>
	 * The tag name of the element.
	 * </p>
	 * @param string $value [optional] <p>
	 * The value of the element. By default, an empty element will be created.
	 * The value can also be set later with DOMElement::$nodeValue.
	 * </p>
	 * @return DOMElement a new instance of class <b>DOMElement</b> or <b>FALSE</b>
	 * if an error occurred.
	 */
	public function createElement ($name, $value = null) {}

	/**
	 * (PHP 5)<br/>
	 * Create new document fragment
	 * @link http://php.net/manual/en/domdocument.createdocumentfragment.php
	 * @return DOMDocumentFragment The new <b>DOMDocumentFragment</b> or <b>FALSE</b> if an error occurred.
	 */
	public function createDocumentFragment () {}

	/**
	 * (PHP 5)<br/>
	 * Create new text node
	 * @link http://php.net/manual/en/domdocument.createtextnode.php
	 * @param string $content <p>
	 * The content of the text.
	 * </p>
	 * @return DOMText The new <b>DOMText</b> or <b>FALSE</b> if an error occurred.
	 */
	public function createTextNode ($content) {}

	/**
	 * (PHP 5)<br/>
	 * Create new comment node
	 * @link http://php.net/manual/en/domdocument.createcomment.php
	 * @param string $data <p>
	 * The content of the comment.
	 * </p>
	 * @return DOMComment The new <b>DOMComment</b> or <b>FALSE</b> if an error occurred.
	 */
	public function createComment ($data) {}

	/**
	 * (PHP 5)<br/>
	 * Create new cdata node
	 * @link http://php.net/manual/en/domdocument.createcdatasection.php
	 * @param string $data <p>
	 * The content of the cdata.
	 * </p>
	 * @return DOMCDATASection The new <b>DOMCDATASection</b> or <b>FALSE</b> if an error occurred.
	 */
	public function createCDATASection ($data) {}

	/**
	 * (PHP 5)<br/>
	 * Creates new PI node
	 * @link http://php.net/manual/en/domdocument.createprocessinginstruction.php
	 * @param string $target <p>
	 * The target of the processing instruction.
	 * </p>
	 * @param string $data [optional] <p>
	 * The content of the processing instruction.
	 * </p>
	 * @return DOMProcessingInstruction The new <b>DOMProcessingInstruction</b> or <b>FALSE</b> if an error occurred.
	 */
	public function createProcessingInstruction ($target, $data = null) {}

	/**
	 * (PHP 5)<br/>
	 * Create new attribute
	 * @link http://php.net/manual/en/domdocument.createattribute.php
	 * @param string $name <p>
	 * The name of the attribute.
	 * </p>
	 * @return DOMAttr The new <b>DOMAttr</b> or <b>FALSE</b> if an error occurred.
	 */
	public function createAttribute ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Create new entity reference node
	 * @link http://php.net/manual/en/domdocument.createentityreference.php
	 * @param string $name <p>
	 * The content of the entity reference, e.g. the entity reference minus
	 * the leading &#38;#38; and the trailing
	 * ; characters.
	 * </p>
	 * @return DOMEntityReference The new <b>DOMEntityReference</b> or <b>FALSE</b> if an error
	 * occurred.
	 */
	public function createEntityReference ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Searches for all elements with given local tag name
	 * @link http://php.net/manual/en/domdocument.getelementsbytagname.php
	 * @param string $name <p>
	 * The local name (without namespace) of the tag to match on. The special value *
	 * matches all tags.
	 * </p>
	 * @return DOMNodeList A new <b>DOMNodeList</b> object containing all the matched
	 * elements.
	 */
	public function getElementsByTagName ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Import node into current document
	 * @link http://php.net/manual/en/domdocument.importnode.php
	 * @param DOMNode $importedNode <p>
	 * The node to import.
	 * </p>
	 * @param bool $deep [optional] <p>
	 * If set to <b>TRUE</b>, this method will recursively import the subtree under
	 * the <i>importedNode</i>.
	 * </p>
	 * <p>
	 * To copy the nodes attributes <i>deep</i> needs to be set to <b>TRUE</b>
	 * </p>
	 * @return DOMNode The copied node or <b>FALSE</b>, if it cannot be copied.
	 */
	public function importNode (DOMNode $importedNode, $deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Create new element node with an associated namespace
	 * @link http://php.net/manual/en/domdocument.createelementns.php
	 * @param string $namespaceURI <p>
	 * The URI of the namespace.
	 * </p>
	 * @param string $qualifiedName <p>
	 * The qualified name of the element, as prefix:tagname.
	 * </p>
	 * @param string $value [optional] <p>
	 * The value of the element. By default, an empty element will be created.
	 * You can also set the value later with DOMElement::$nodeValue.
	 * </p>
	 * @return DOMElement The new <b>DOMElement</b> or <b>FALSE</b> if an error occurred.
	 */
	public function createElementNS ($namespaceURI, $qualifiedName, $value = null) {}

	/**
	 * (PHP 5)<br/>
	 * Create new attribute node with an associated namespace
	 * @link http://php.net/manual/en/domdocument.createattributens.php
	 * @param string $namespaceURI <p>
	 * The URI of the namespace.
	 * </p>
	 * @param string $qualifiedName <p>
	 * The tag name and prefix of the attribute, as prefix:tagname.
	 * </p>
	 * @return DOMAttr The new <b>DOMAttr</b> or <b>FALSE</b> if an error occurred.
	 */
	public function createAttributeNS ($namespaceURI, $qualifiedName) {}

	/**
	 * (PHP 5)<br/>
	 * Searches for all elements with given tag name in specified namespace
	 * @link http://php.net/manual/en/domdocument.getelementsbytagnamens.php
	 * @param string $namespaceURI <p>
	 * The namespace URI of the elements to match on.
	 * The special value * matches all namespaces.
	 * </p>
	 * @param string $localName <p>
	 * The local name of the elements to match on.
	 * The special value * matches all local names.
	 * </p>
	 * @return DOMNodeList A new <b>DOMNodeList</b> object containing all the matched
	 * elements.
	 */
	public function getElementsByTagNameNS ($namespaceURI, $localName) {}

	/**
	 * (PHP 5)<br/>
	 * Searches for an element with a certain id
	 * @link http://php.net/manual/en/domdocument.getelementbyid.php
	 * @param string $elementId <p>
	 * The unique id value for an element.
	 * </p>
	 * @return DOMElement the <b>DOMElement</b> or <b>NULL</b> if the element is
	 * not found.
	 */
	public function getElementById ($elementId) {}

	/**
	 * @param DOMNode $source
	 */
	public function adoptNode (DOMNode $source) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the document
	 * @link http://php.net/manual/en/domdocument.normalizedocument.php
	 * @return void No value is returned.
	 */
	public function normalizeDocument () {}

	/**
	 * @param DOMNode $node
	 * @param $namespaceURI
	 * @param $qualifiedName
	 */
	public function renameNode (DOMNode $node, $namespaceURI, $qualifiedName) {}

	/**
	 * (PHP 5)<br/>
	 * Load XML from a file
	 * @link http://php.net/manual/en/domdocument.load.php
	 * @param string $filename <p>
	 * The path to the XML document.
	 * </p>
	 * @param int $options [optional] <p>
	 * Bitwise OR
	 * of the libxml option constants.
	 * </p>
	 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure. If called statically, returns a
	 * <b>DOMDocument</b> or <b>FALSE</b> on failure.
	 */
	public function load ($filename, $options = 0) {}

	/**
	 * (PHP 5)<br/>
	 * Dumps the internal XML tree back into a file
	 * @link http://php.net/manual/en/domdocument.save.php
	 * @param string $filename <p>
	 * The path to the saved XML document.
	 * </p>
	 * @param int $options [optional] <p>
	 * Additional Options. Currently only LIBXML_NOEMPTYTAG is supported.
	 * </p>
	 * @return int the number of bytes written or <b>FALSE</b> if an error occurred.
	 */
	public function save ($filename, $options = null) {}

	/**
	 * (PHP 5)<br/>
	 * Load XML from a string
	 * @link http://php.net/manual/en/domdocument.loadxml.php
	 * @param string $source <p>
	 * The string containing the XML.
	 * </p>
	 * @param int $options [optional] <p>
	 * Bitwise OR
	 * of the libxml option constants.
	 * </p>
	 * @return mixed <b>TRUE</b> on success or <b>FALSE</b> on failure. If called statically, returns a
	 * <b>DOMDocument</b> or <b>FALSE</b> on failure.
	 */
	public function loadXML ($source, $options = 0) {}

	/**
	 * (PHP 5)<br/>
	 * Dumps the internal XML tree back into a string
	 * @link http://php.net/manual/en/domdocument.savexml.php
	 * @param DOMNode $node [optional] <p>
	 * Use this parameter to output only a specific node without XML declaration
	 * rather than the entire document.
	 * </p>
	 * @param int $options [optional] <p>
	 * Additional Options. Currently only LIBXML_NOEMPTYTAG is supported.
	 * </p>
	 * @return string the XML, or <b>FALSE</b> if an error occurred.
	 */
	public function saveXML (DOMNode $node = null, $options = null) {}

	/**
	 * (PHP 5)<br/>
	 * Creates a new DOMDocument object
	 * @link http://php.net/manual/en/domdocument.construct.php
	 * @param string $version [optional] <p>
	 * The version number of the document as part of the XML declaration.
	 * </p>
	 * @param string $encoding [optional] <p>
	 * The encoding of the document as part of the XML declaration.
	 * </p>
	 */
	public function __construct ($version = null, $encoding = null) {}

	/**
	 * (PHP 5)<br/>
	 * Validates the document based on its DTD
	 * @link http://php.net/manual/en/domdocument.validate.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 * If the document have no DTD attached, this method will return <b>FALSE</b>.
	 */
	public function validate () {}

	/**
	 * (PHP 5)<br/>
	 * Substitutes XIncludes in a DOMDocument Object
	 * @link http://php.net/manual/en/domdocument.xinclude.php
	 * @param int $options [optional] <p>
	 * libxml parameters. Available
	 * since PHP 5.1.0 and Libxml 2.6.7.
	 * </p>
	 * @return int the number of XIncludes in the document, -1 if some processing failed,
	 * or <b>FALSE</b> if there were no substitutions.
	 */
	public function xinclude ($options = null) {}

	/**
	 * (PHP 5)<br/>
	 * Load HTML from a string
	 * @link http://php.net/manual/en/domdocument.loadhtml.php
	 * @param string $source <p>
	 * The HTML string.
	 * </p>
	 * @param int $options [optional] <p>
	 * Since PHP 5.4.0 and Libxml 2.6.0, you may also use the
	 * <i>options</i> parameter to specify additional Libxml parameters.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure. If called statically, returns a
	 * <b>DOMDocument</b> or <b>FALSE</b> on failure.
	 */
	public function loadHTML ($source, $options = 0) {}

	/**
	 * (PHP 5)<br/>
	 * Load HTML from a file
	 * @link http://php.net/manual/en/domdocument.loadhtmlfile.php
	 * @param string $filename <p>
	 * The path to the HTML file.
	 * </p>
	 * @param int $options [optional] <p>
	 * Since PHP 5.4.0 and Libxml 2.6.0, you may also use the
	 * <i>options</i> parameter to specify additional Libxml parameters.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure. If called statically, returns a
	 * <b>DOMDocument</b> or <b>FALSE</b> on failure.
	 */
	public function loadHTMLFile ($filename, $options = 0) {}

	/**
	 * (PHP 5)<br/>
	 * Dumps the internal document into a string using HTML formatting
	 * @link http://php.net/manual/en/domdocument.savehtml.php
	 * @param DOMNode $node [optional] <p>
	 * Optional parameter to output a subset of the document.
	 * </p>
	 * @return string the HTML, or <b>FALSE</b> if an error occurred.
	 */
	public function saveHTML (DOMNode $node = NULL) {}

	/**
	 * (PHP 5)<br/>
	 * Dumps the internal document into a file using HTML formatting
	 * @link http://php.net/manual/en/domdocument.savehtmlfile.php
	 * @param string $filename <p>
	 * The path to the saved HTML document.
	 * </p>
	 * @return int the number of bytes written or <b>FALSE</b> if an error occurred.
	 */
	public function saveHTMLFile ($filename) {}

	/**
	 * (PHP 5)<br/>
	 * Validates a document based on a schema
	 * @link http://php.net/manual/en/domdocument.schemavalidate.php
	 * @param string $filename <p>
	 * The path to the schema.
	 * </p>
	 * @param int $flags [optional] <p>
	 * A bitmask of Libxml schema validation flags. Currently the only supported value is LIBXML_SCHEMA_CREATE. Available since PHP 5.5.2 and Libxml 2.6.14.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function schemaValidate ($filename, $flags = null) {}

	/**
	 * (PHP 5)<br/>
	 * Validates a document based on a schema
	 * @link http://php.net/manual/en/domdocument.schemavalidatesource.php
	 * @param string $source <p>
	 * A string containing the schema.
	 * </p>
	 * @param int $flags [optional] <p>
	 * A bitmask of Libxml schema validation flags. Currently the only supported value is LIBXML_SCHEMA_CREATE. Available since PHP 5.5.2 and Libxml 2.6.14.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function schemaValidateSource ($source, $flags = null) {}

	/**
	 * (PHP 5)<br/>
	 * Performs relaxNG validation on the document
	 * @link http://php.net/manual/en/domdocument.relaxngvalidate.php
	 * @param string $filename <p>
	 * The RNG file.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function relaxNGValidate ($filename) {}

	/**
	 * (PHP 5)<br/>
	 * Performs relaxNG validation on the document
	 * @link http://php.net/manual/en/domdocument.relaxngvalidatesource.php
	 * @param string $source <p>
	 * A string containing the RNG schema.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function relaxNGValidateSource ($source) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Register extended class used to create base node type
	 * @link http://php.net/manual/en/domdocument.registernodeclass.php
	 * @param string $baseclass <p>
	 * The DOM class that you want to extend. You can find a list of these
	 * classes in the chapter introduction.
	 * </p>
	 * @param string $extendedclass <p>
	 * Your extended class name. If <b>NULL</b> is provided, any previously
	 * registered class extending <i>baseclass</i> will
	 * be removed.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function registerNodeClass ($baseclass, $extendedclass) {}

	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

/**
 * @link http://php.net/manual/en/class.domnodelist.php
 */
class DOMNodeList implements Traversable {
	/**
	 * <p style="margin-top:0;">
	 * The number of nodes in the list. The range of valid child node
	 * indices is 0 to length - 1 inclusive.
	 * </p>
	 * @var int
	 */
	public $length;


	/**
	 * (PHP 5)<br/>
	 * Retrieves a node specified by index
	 * @link http://php.net/manual/en/domnodelist.item.php
	 * @param int $index <p>
	 * Index of the node into the collection.
	 * </p>
	 * @return DOMNode The node at the <i>index</i>th position in the
	 * <b>DOMNodeList</b>, or <b>NULL</b> if that is not a valid
	 * index.
	 */
	public function item ($index) {}

}

/**
 * @link http://php.net/manual/en/class.domnamednodemap.php
 */
class DOMNamedNodeMap implements Traversable {
	/**
	 * <p style="margin-top:0;">
	 * The number of nodes in the map. The range of valid child node
	 * indices is 0 to length - 1 inclusive.
	 * </p>
	 * @var int
	 */
	public $length;


	/**
	 * (PHP 5)<br/>
	 * Retrieves a node specified by name
	 * @link http://php.net/manual/en/domnamednodemap.getnameditem.php
	 * @param string $name <p>
	 * The nodeName of the node to retrieve.
	 * </p>
	 * @return DOMNode A node (of any type) with the specified nodeName, or
	 * <b>NULL</b> if no node is found.
	 */
	public function getNamedItem ($name) {}

	/**
	 * @param DOMNode $arg
	 */
	public function setNamedItem (DOMNode $arg) {}

	/**
	 * @param $name [optional]
	 */
	public function removeNamedItem ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Retrieves a node specified by index
	 * @link http://php.net/manual/en/domnamednodemap.item.php
	 * @param int $index <p>
	 * Index into this map.
	 * </p>
	 * @return DOMNode The node at the <i>index</i>th position in the map, or <b>NULL</b>
	 * if that is not a valid index (greater than or equal to the number of nodes
	 * in this map).
	 */
	public function item ($index) {}

	/**
	 * (PHP 5)<br/>
	 * Retrieves a node specified by local name and namespace URI
	 * @link http://php.net/manual/en/domnamednodemap.getnameditemns.php
	 * @param string $namespaceURI <p>
	 * The namespace URI of the node to retrieve.
	 * </p>
	 * @param string $localName <p>
	 * The local name of the node to retrieve.
	 * </p>
	 * @return DOMNode A node (of any type) with the specified local name and namespace URI, or
	 * <b>NULL</b> if no node is found.
	 */
	public function getNamedItemNS ($namespaceURI, $localName) {}

	/**
	 * @param DOMNode $arg [optional]
	 */
	public function setNamedItemNS (DOMNode $arg) {}

	/**
	 * @param $namespaceURI [optional]
	 * @param $localName [optional]
	 */
	public function removeNamedItemNS ($namespaceURI, $localName) {}

}

/**
 * Represents nodes with character data. No nodes directly correspond to
 * this class, but other nodes do inherit from it.
 * @link http://php.net/manual/en/class.domcharacterdata.php
 */
class DOMCharacterData extends DOMNode  {
	/**
	 * <p style="margin-top:0;">The contents of the node.</p>
	 * @var string
	 */
	public $data;
	/**
	 * <p style="margin-top:0;">The length of the contents.</p>
	 * @var int
	 */
	public $length;


	/**
	 * (PHP 5)<br/>
	 * Extracts a range of data from the node
	 * @link http://php.net/manual/en/domcharacterdata.substringdata.php
	 * @param int $offset <p>
	 * Start offset of substring to extract.
	 * </p>
	 * @param int $count <p>
	 * The number of characters to extract.
	 * </p>
	 * @return string The specified substring. If the sum of <i>offset</i>
	 * and <i>count</i> exceeds the length, then all 16-bit units
	 * to the end of the data are returned.
	 */
	public function substringData ($offset, $count) {}

	/**
	 * (PHP 5)<br/>
	 * Append the string to the end of the character data of the node
	 * @link http://php.net/manual/en/domcharacterdata.appenddata.php
	 * @param string $data <p>
	 * The string to append.
	 * </p>
	 * @return void No value is returned.
	 */
	public function appendData ($data) {}

	/**
	 * (PHP 5)<br/>
	 * Insert a string at the specified 16-bit unit offset
	 * @link http://php.net/manual/en/domcharacterdata.insertdata.php
	 * @param int $offset <p>
	 * The character offset at which to insert.
	 * </p>
	 * @param string $data <p>
	 * The string to insert.
	 * </p>
	 * @return void No value is returned.
	 */
	public function insertData ($offset, $data) {}

	/**
	 * (PHP 5)<br/>
	 * Remove a range of characters from the node
	 * @link http://php.net/manual/en/domcharacterdata.deletedata.php
	 * @param int $offset <p>
	 * The offset from which to start removing.
	 * </p>
	 * @param int $count <p>
	 * The number of characters to delete. If the sum of
	 * <i>offset</i> and <i>count</i> exceeds
	 * the length, then all characters to the end of the data are deleted.
	 * </p>
	 * @return void No value is returned.
	 */
	public function deleteData ($offset, $count) {}

	/**
	 * (PHP 5)<br/>
	 * Replace a substring within the DOMCharacterData node
	 * @link http://php.net/manual/en/domcharacterdata.replacedata.php
	 * @param int $offset <p>
	 * The offset from which to start replacing.
	 * </p>
	 * @param int $count <p>
	 * The number of characters to replace. If the sum of
	 * <i>offset</i> and <i>count</i> exceeds
	 * the length, then all characters to the end of the data are replaced.
	 * </p>
	 * @param string $data <p>
	 * The string with which the range must be replaced.
	 * </p>
	 * @return void No value is returned.
	 */
	public function replaceData ($offset, $count, $data) {}

	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

/**
 * <b>DOMAttr</b> represents an attribute in the
 * <b>DOMElement</b> object.
 * @link http://php.net/manual/en/class.domattr.php
 */
class DOMAttr extends DOMNode  {
	/**
	 * <p style="margin-top:0;">The name of the attribute</p>
	 * @var string
	 */
	public $name;
	/**
	 * <p style="margin-top:0;">The element which contains the attribute</p>
	 * @var DOMElement
	 */
	public $ownerElement;
	/**
	 * <p style="margin-top:0;">Not implemented yet, always is <b><code>NULL</code></b></p>
	 * @var bool
	 */
	public $schemaTypeInfo;
	/**
	 * <p style="margin-top:0;">Not implemented yet, always is <b><code>NULL</code></b></p>
	 * @var bool
	 */
	public $specified;
	/**
	 * <p style="margin-top:0;">The value of the attribute</p>
	 * @var string
	 */
	public $value;


	/**
	 * (PHP 5)<br/>
	 * Checks if attribute is a defined ID
	 * @link http://php.net/manual/en/domattr.isid.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isId () {}

	/**
	 * (PHP 5)<br/>
	 * Creates a new <b>DOMAttr</b> object
	 * @link http://php.net/manual/en/domattr.construct.php
	 * @param string $name <p>
	 * The tag name of the attribute.
	 * </p>
	 * @param string $value [optional] <p>
	 * The value of the attribute.
	 * </p>
	 */
	public function __construct ($name, $value = null) {}

	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

/**
 * @link http://php.net/manual/en/class.domelement.php
 */
class DOMElement extends DOMNode  {
	/**
	 * <p style="margin-top:0;">Not implemented yet, always return <b><code>NULL</code></b></p>
	 * @var bool
	 */
	public $schemaTypeInfo;
	/**
	 * <p style="margin-top:0;">The element name</p>
	 * @var string
	 */
	public $tagName;


	/**
	 * (PHP 5)<br/>
	 * Returns value of attribute
	 * @link http://php.net/manual/en/domelement.getattribute.php
	 * @param string $name <p>
	 * The name of the attribute.
	 * </p>
	 * @return string The value of the attribute, or an empty string if no attribute with the
	 * given <i>name</i> is found.
	 */
	public function getAttribute ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new attribute
	 * @link http://php.net/manual/en/domelement.setattribute.php
	 * @param string $name <p>
	 * The name of the attribute.
	 * </p>
	 * @param string $value <p>
	 * The value of the attribute.
	 * </p>
	 * @return DOMAttr The new <b>DOMAttr</b> or <b>FALSE</b> if an error occurred.
	 */
	public function setAttribute ($name, $value) {}

	/**
	 * (PHP 5)<br/>
	 * Removes attribute
	 * @link http://php.net/manual/en/domelement.removeattribute.php
	 * @param string $name <p>
	 * The name of the attribute.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function removeAttribute ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Returns attribute node
	 * @link http://php.net/manual/en/domelement.getattributenode.php
	 * @param string $name <p>
	 * The name of the attribute.
	 * </p>
	 * @return DOMAttr The attribute node.
	 */
	public function getAttributeNode ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new attribute node to element
	 * @link http://php.net/manual/en/domelement.setattributenode.php
	 * @param DOMAttr $attr <p>
	 * The attribute node.
	 * </p>
	 * @return DOMAttr old node if the attribute has been replaced or <b>NULL</b>.
	 */
	public function setAttributeNode (DOMAttr $attr) {}

	/**
	 * (PHP 5)<br/>
	 * Removes attribute
	 * @link http://php.net/manual/en/domelement.removeattributenode.php
	 * @param DOMAttr $oldnode <p>
	 * The attribute node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function removeAttributeNode (DOMAttr $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Gets elements by tagname
	 * @link http://php.net/manual/en/domelement.getelementsbytagname.php
	 * @param string $name <p>
	 * The tag name. Use * to return all elements within
	 * the element tree.
	 * </p>
	 * @return DOMNodeList This function returns a new instance of the class
	 * <b>DOMNodeList</b> of all matched elements.
	 */
	public function getElementsByTagName ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Returns value of attribute
	 * @link http://php.net/manual/en/domelement.getattributens.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @param string $localName <p>
	 * The local name.
	 * </p>
	 * @return string The value of the attribute, or an empty string if no attribute with the
	 * given <i>localName</i> and <i>namespaceURI</i>
	 * is found.
	 */
	public function getAttributeNS ($namespaceURI, $localName) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new attribute
	 * @link http://php.net/manual/en/domelement.setattributens.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @param string $qualifiedName <p>
	 * The qualified name of the attribute, as prefix:tagname.
	 * </p>
	 * @param string $value <p>
	 * The value of the attribute.
	 * </p>
	 * @return void No value is returned.
	 */
	public function setAttributeNS ($namespaceURI, $qualifiedName, $value) {}

	/**
	 * (PHP 5)<br/>
	 * Removes attribute
	 * @link http://php.net/manual/en/domelement.removeattributens.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @param string $localName <p>
	 * The local name.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function removeAttributeNS ($namespaceURI, $localName) {}

	/**
	 * (PHP 5)<br/>
	 * Returns attribute node
	 * @link http://php.net/manual/en/domelement.getattributenodens.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @param string $localName <p>
	 * The local name.
	 * </p>
	 * @return DOMAttr The attribute node.
	 */
	public function getAttributeNodeNS ($namespaceURI, $localName) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new attribute node to element
	 * @link http://php.net/manual/en/domelement.setattributenodens.php
	 * @param DOMAttr $attr <p>
	 * The attribute node.
	 * </p>
	 * @return DOMAttr the old node if the attribute has been replaced.
	 */
	public function setAttributeNodeNS (DOMAttr $attr) {}

	/**
	 * (PHP 5)<br/>
	 * Get elements by namespaceURI and localName
	 * @link http://php.net/manual/en/domelement.getelementsbytagnamens.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @param string $localName <p>
	 * The local name. Use * to return all elements within
	 * the element tree.
	 * </p>
	 * @return DOMNodeList This function returns a new instance of the class
	 * <b>DOMNodeList</b> of all matched elements in the order in
	 * which they are encountered in a preorder traversal of this element tree.
	 */
	public function getElementsByTagNameNS ($namespaceURI, $localName) {}

	/**
	 * (PHP 5)<br/>
	 * Checks to see if attribute exists
	 * @link http://php.net/manual/en/domelement.hasattribute.php
	 * @param string $name <p>
	 * The attribute name.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttribute ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Checks to see if attribute exists
	 * @link http://php.net/manual/en/domelement.hasattributens.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @param string $localName <p>
	 * The local name.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributeNS ($namespaceURI, $localName) {}

	/**
	 * (PHP 5)<br/>
	 * Declares the attribute specified by name to be of type ID
	 * @link http://php.net/manual/en/domelement.setidattribute.php
	 * @param string $name <p>
	 * The name of the attribute.
	 * </p>
	 * @param bool $isId <p>
	 * Set it to <b>TRUE</b> if you want <i>name</i> to be of type
	 * ID, <b>FALSE</b> otherwise.
	 * </p>
	 * @return void No value is returned.
	 */
	public function setIdAttribute ($name, $isId) {}

	/**
	 * (PHP 5)<br/>
	 * Declares the attribute specified by local name and namespace URI to be of type ID
	 * @link http://php.net/manual/en/domelement.setidattributens.php
	 * @param string $namespaceURI <p>
	 * The namespace URI of the attribute.
	 * </p>
	 * @param string $localName <p>
	 * The local name of the attribute, as prefix:tagname.
	 * </p>
	 * @param bool $isId <p>
	 * Set it to <b>TRUE</b> if you want <i>name</i> to be of type
	 * ID, <b>FALSE</b> otherwise.
	 * </p>
	 * @return void No value is returned.
	 */
	public function setIdAttributeNS ($namespaceURI, $localName, $isId) {}

	/**
	 * (PHP 5)<br/>
	 * Declares the attribute specified by node to be of type ID
	 * @link http://php.net/manual/en/domelement.setidattributenode.php
	 * @param DOMAttr $attr <p>
	 * The attribute node.
	 * </p>
	 * @param bool $isId <p>
	 * Set it to <b>TRUE</b> if you want <i>name</i> to be of type
	 * ID, <b>FALSE</b> otherwise.
	 * </p>
	 * @return void No value is returned.
	 */
	public function setIdAttributeNode (DOMAttr $attr, $isId) {}

	/**
	 * (PHP 5)<br/>
	 * Creates a new DOMElement object
	 * @link http://php.net/manual/en/domelement.construct.php
	 * @param string $name <p>
	 * The tag name of the element. When also passing in namespaceURI, the element name
	 * may take a prefix to be associated with the URI.
	 * </p>
	 * @param string $value [optional] <p>
	 * The value of the element.
	 * </p>
	 * @param string $namespaceURI [optional] <p>
	 * A namespace URI to create the element within a specific namespace.
	 * </p>
	 */
	public function __construct ($name, $value = null, $namespaceURI = null) {}

	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

/**
 * The <b>DOMText</b> class inherits from
 * <b>DOMCharacterData</b> and represents the textual
 * content of a <b>DOMElement</b> or
 * <b>DOMAttr</b>.
 * @link http://php.net/manual/en/class.domtext.php
 */
class DOMText extends DOMCharacterData  {
	/**
	 * <p style="margin-top:0;">
	 * Holds all the text of logically-adjacent (not separated by Element,
	 * Comment or Processing Instruction) Text nodes.
	 * </p>
	 * @var string
	 */
	public $wholeText;


	/**
	 * (PHP 5)<br/>
	 * Breaks this node into two nodes at the specified offset
	 * @link http://php.net/manual/en/domtext.splittext.php
	 * @param int $offset <p>
	 * The offset at which to split, starting from 0.
	 * </p>
	 * @return DOMText The new node of the same type, which contains all the content at and after the
	 * <i>offset</i>.
	 */
	public function splitText ($offset) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates whether this text node contains whitespace
	 * @link http://php.net/manual/en/domtext.iswhitespaceinelementcontent.php
	 * @return bool <b>TRUE</b> if node contains zero or more whitespace characters and
	 * nothing else. Returns <b>FALSE</b> otherwise.
	 */
	public function isWhitespaceInElementContent () {}

	public function isElementContentWhitespace () {}

	/**
	 * @param $content
	 */
	public function replaceWholeText ($content) {}

	/**
	 * (PHP 5)<br/>
	 * Creates a new <b>DOMText</b> object
	 * @link http://php.net/manual/en/domtext.construct.php
	 * @param $value [optional]
	 */
	public function __construct ($value) {}

	/**
	 * (PHP 5)<br/>
	 * Extracts a range of data from the node
	 * @link http://php.net/manual/en/domcharacterdata.substringdata.php
	 * @param int $offset <p>
	 * Start offset of substring to extract.
	 * </p>
	 * @param int $count <p>
	 * The number of characters to extract.
	 * </p>
	 * @return string The specified substring. If the sum of <i>offset</i>
	 * and <i>count</i> exceeds the length, then all 16-bit units
	 * to the end of the data are returned.
	 */
	public function substringData ($offset, $count) {}

	/**
	 * (PHP 5)<br/>
	 * Append the string to the end of the character data of the node
	 * @link http://php.net/manual/en/domcharacterdata.appenddata.php
	 * @param string $data <p>
	 * The string to append.
	 * </p>
	 * @return void No value is returned.
	 */
	public function appendData ($data) {}

	/**
	 * (PHP 5)<br/>
	 * Insert a string at the specified 16-bit unit offset
	 * @link http://php.net/manual/en/domcharacterdata.insertdata.php
	 * @param int $offset <p>
	 * The character offset at which to insert.
	 * </p>
	 * @param string $data <p>
	 * The string to insert.
	 * </p>
	 * @return void No value is returned.
	 */
	public function insertData ($offset, $data) {}

	/**
	 * (PHP 5)<br/>
	 * Remove a range of characters from the node
	 * @link http://php.net/manual/en/domcharacterdata.deletedata.php
	 * @param int $offset <p>
	 * The offset from which to start removing.
	 * </p>
	 * @param int $count <p>
	 * The number of characters to delete. If the sum of
	 * <i>offset</i> and <i>count</i> exceeds
	 * the length, then all characters to the end of the data are deleted.
	 * </p>
	 * @return void No value is returned.
	 */
	public function deleteData ($offset, $count) {}

	/**
	 * (PHP 5)<br/>
	 * Replace a substring within the DOMCharacterData node
	 * @link http://php.net/manual/en/domcharacterdata.replacedata.php
	 * @param int $offset <p>
	 * The offset from which to start replacing.
	 * </p>
	 * @param int $count <p>
	 * The number of characters to replace. If the sum of
	 * <i>offset</i> and <i>count</i> exceeds
	 * the length, then all characters to the end of the data are replaced.
	 * </p>
	 * @param string $data <p>
	 * The string with which the range must be replaced.
	 * </p>
	 * @return void No value is returned.
	 */
	public function replaceData ($offset, $count, $data) {}

	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

/**
 * Represents comment nodes, characters delimited by &lt;!--
 * and --&gt;.
 * @link http://php.net/manual/en/class.domcomment.php
 */
class DOMComment extends DOMCharacterData  {

	/**
	 * (PHP 5)<br/>
	 * Creates a new DOMComment object
	 * @link http://php.net/manual/en/domcomment.construct.php
	 * @param string $value [optional] <p>
	 * The value of the comment.
	 * </p>
	 */
	public function __construct ($value = null) {}

	/**
	 * (PHP 5)<br/>
	 * Extracts a range of data from the node
	 * @link http://php.net/manual/en/domcharacterdata.substringdata.php
	 * @param int $offset <p>
	 * Start offset of substring to extract.
	 * </p>
	 * @param int $count <p>
	 * The number of characters to extract.
	 * </p>
	 * @return string The specified substring. If the sum of <i>offset</i>
	 * and <i>count</i> exceeds the length, then all 16-bit units
	 * to the end of the data are returned.
	 */
	public function substringData ($offset, $count) {}

	/**
	 * (PHP 5)<br/>
	 * Append the string to the end of the character data of the node
	 * @link http://php.net/manual/en/domcharacterdata.appenddata.php
	 * @param string $data <p>
	 * The string to append.
	 * </p>
	 * @return void No value is returned.
	 */
	public function appendData ($data) {}

	/**
	 * (PHP 5)<br/>
	 * Insert a string at the specified 16-bit unit offset
	 * @link http://php.net/manual/en/domcharacterdata.insertdata.php
	 * @param int $offset <p>
	 * The character offset at which to insert.
	 * </p>
	 * @param string $data <p>
	 * The string to insert.
	 * </p>
	 * @return void No value is returned.
	 */
	public function insertData ($offset, $data) {}

	/**
	 * (PHP 5)<br/>
	 * Remove a range of characters from the node
	 * @link http://php.net/manual/en/domcharacterdata.deletedata.php
	 * @param int $offset <p>
	 * The offset from which to start removing.
	 * </p>
	 * @param int $count <p>
	 * The number of characters to delete. If the sum of
	 * <i>offset</i> and <i>count</i> exceeds
	 * the length, then all characters to the end of the data are deleted.
	 * </p>
	 * @return void No value is returned.
	 */
	public function deleteData ($offset, $count) {}

	/**
	 * (PHP 5)<br/>
	 * Replace a substring within the DOMCharacterData node
	 * @link http://php.net/manual/en/domcharacterdata.replacedata.php
	 * @param int $offset <p>
	 * The offset from which to start replacing.
	 * </p>
	 * @param int $count <p>
	 * The number of characters to replace. If the sum of
	 * <i>offset</i> and <i>count</i> exceeds
	 * the length, then all characters to the end of the data are replaced.
	 * </p>
	 * @param string $data <p>
	 * The string with which the range must be replaced.
	 * </p>
	 * @return void No value is returned.
	 */
	public function replaceData ($offset, $count, $data) {}

	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

class DOMTypeinfo  {
}

class DOMUserDataHandler  {

	public function handle () {}

}

class DOMDomError  {
}

class DOMErrorHandler  {

	/**
	 * @param DOMDomError $error
	 */
	public function handleError (DOMDomError $error) {}

}

class DOMLocator  {
}

class DOMConfiguration  {

	/**
	 * @param $name
	 * @param $value
	 */
	public function setParameter ($name, $value) {}

	/**
	 * @param $name [optional]
	 */
	public function getParameter ($name) {}

	/**
	 * @param $name [optional]
	 * @param $value [optional]
	 */
	public function canSetParameter ($name, $value) {}

}

/**
 * The <b>DOMCdataSection</b> inherits from
 * <b>DOMText</b> for textural representation
 * of CData constructs.
 * @link http://php.net/manual/en/class.domcdatasection.php
 */
class DOMCdataSection extends DOMText  {

	/**
	 * (PHP 5)<br/>
	 * Constructs a new DOMCdataSection object
	 * @link http://php.net/manual/en/domcdatasection.construct.php
	 * @param string $value <p>
	 * The value of the CDATA node. If not supplied, an empty CDATA node is created.
	 * </p>
	 */
	public function __construct ($value) {}

	/**
	 * (PHP 5)<br/>
	 * Breaks this node into two nodes at the specified offset
	 * @link http://php.net/manual/en/domtext.splittext.php
	 * @param int $offset <p>
	 * The offset at which to split, starting from 0.
	 * </p>
	 * @return DOMText The new node of the same type, which contains all the content at and after the
	 * <i>offset</i>.
	 */
	public function splitText ($offset) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates whether this text node contains whitespace
	 * @link http://php.net/manual/en/domtext.iswhitespaceinelementcontent.php
	 * @return bool <b>TRUE</b> if node contains zero or more whitespace characters and
	 * nothing else. Returns <b>FALSE</b> otherwise.
	 */
	public function isWhitespaceInElementContent () {}

	public function isElementContentWhitespace () {}

	/**
	 * @param $content
	 */
	public function replaceWholeText ($content) {}

	/**
	 * (PHP 5)<br/>
	 * Extracts a range of data from the node
	 * @link http://php.net/manual/en/domcharacterdata.substringdata.php
	 * @param int $offset <p>
	 * Start offset of substring to extract.
	 * </p>
	 * @param int $count <p>
	 * The number of characters to extract.
	 * </p>
	 * @return string The specified substring. If the sum of <i>offset</i>
	 * and <i>count</i> exceeds the length, then all 16-bit units
	 * to the end of the data are returned.
	 */
	public function substringData ($offset, $count) {}

	/**
	 * (PHP 5)<br/>
	 * Append the string to the end of the character data of the node
	 * @link http://php.net/manual/en/domcharacterdata.appenddata.php
	 * @param string $data <p>
	 * The string to append.
	 * </p>
	 * @return void No value is returned.
	 */
	public function appendData ($data) {}

	/**
	 * (PHP 5)<br/>
	 * Insert a string at the specified 16-bit unit offset
	 * @link http://php.net/manual/en/domcharacterdata.insertdata.php
	 * @param int $offset <p>
	 * The character offset at which to insert.
	 * </p>
	 * @param string $data <p>
	 * The string to insert.
	 * </p>
	 * @return void No value is returned.
	 */
	public function insertData ($offset, $data) {}

	/**
	 * (PHP 5)<br/>
	 * Remove a range of characters from the node
	 * @link http://php.net/manual/en/domcharacterdata.deletedata.php
	 * @param int $offset <p>
	 * The offset from which to start removing.
	 * </p>
	 * @param int $count <p>
	 * The number of characters to delete. If the sum of
	 * <i>offset</i> and <i>count</i> exceeds
	 * the length, then all characters to the end of the data are deleted.
	 * </p>
	 * @return void No value is returned.
	 */
	public function deleteData ($offset, $count) {}

	/**
	 * (PHP 5)<br/>
	 * Replace a substring within the DOMCharacterData node
	 * @link http://php.net/manual/en/domcharacterdata.replacedata.php
	 * @param int $offset <p>
	 * The offset from which to start replacing.
	 * </p>
	 * @param int $count <p>
	 * The number of characters to replace. If the sum of
	 * <i>offset</i> and <i>count</i> exceeds
	 * the length, then all characters to the end of the data are replaced.
	 * </p>
	 * @param string $data <p>
	 * The string with which the range must be replaced.
	 * </p>
	 * @return void No value is returned.
	 */
	public function replaceData ($offset, $count, $data) {}

	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

/**
 * Each <b>DOMDocument</b> has a doctype
 * attribute whose value is either <b>NULL</b> or a <b>DOMDocumentType</b> object.
 * @link http://php.net/manual/en/class.domdocumenttype.php
 */
class DOMDocumentType extends DOMNode  {
	/**
	 * <p style="margin-top:0;">The public identifier of the external subset.</p>
	 * @var string
	 */
	public $publicId;
	/**
	 * <p style="margin-top:0;">
	 * The system identifier of the external subset. This may be an
	 * absolute URI or not.
	 * </p>
	 * @var string
	 */
	public $systemId;
	/**
	 * <p style="margin-top:0;">
	 * The name of DTD; i.e., the name immediately following the
	 * DOCTYPE keyword.
	 * </p>
	 * @var string
	 */
	public $name;
	/**
	 * <p style="margin-top:0;">
	 * A <b>DOMNamedNodeMap</b> containing the general
	 * entities, both external and internal, declared in the DTD.
	 * </p>
	 * @var DOMNamedNodeMap
	 */
	public $entities;
	/**
	 * <p style="margin-top:0;">
	 * A <b>DOMNamedNodeMap</b> containing the notations
	 * declared in the DTD.
	 * </p>
	 * @var DOMNamedNodeMap
	 */
	public $notations;
	/**
	 * <p style="margin-top:0;">
	 * The internal subset as a string, or null if there is none. This
	 * does not contain the delimiting square brackets.
	 * </p>
	 * @var string
	 */
	public $internalSubset;


	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

/**
 * @link http://php.net/manual/en/class.domnotation.php
 */
class DOMNotation extends DOMNode  {
	/**
	 * <p></p>
	 * @var string
	 */
	public $publicId;
	/**
	 * <p></p>
	 * @var string
	 */
	public $systemId;


	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

/**
 * This interface represents a known entity, either parsed or unparsed, in an XML document.
 * @link http://php.net/manual/en/class.domentity.php
 */
class DOMEntity extends DOMNode  {
	/**
	 * <p style="margin-top:0;">
	 * The public identifier associated with the entity if specified, and
	 * <b><code>NULL</code></b> otherwise.
	 * </p>
	 * @var string
	 */
	public $publicId;
	/**
	 * <p style="margin-top:0;">
	 * The system identifier associated with the entity if specified, and
	 * <b><code>NULL</code></b> otherwise. This may be an absolute URI or not.
	 * </p>
	 * @var string
	 */
	public $systemId;
	/**
	 * <p style="margin-top:0;">
	 * For unparsed entities, the name of the notation for the entity. For
	 * parsed entities, this is <b><code>NULL</code></b>.
	 * </p>
	 * @var string
	 */
	public $notationName;
	/**
	 * <p style="margin-top:0;">
	 * An attribute specifying the encoding used for this entity at the
	 * time of parsing, when it is an external parsed entity. This is
	 * <b><code>NULL</code></b> if it an entity from the internal subset or if it is not
	 * known.
	 * </p>
	 * @var string
	 */
	public $actualEncoding;
	/**
	 * <p style="margin-top:0;">
	 * An attribute specifying, as part of the text declaration, the
	 * encoding of this entity, when it is an external parsed entity. This
	 * is <b><code>NULL</code></b> otherwise.
	 * </p>
	 * @var string
	 */
	public $encoding;
	/**
	 * <p style="margin-top:0;">
	 * An attribute specifying, as part of the text declaration, the
	 * version number of this entity, when it is an external parsed
	 * entity. This is <b><code>NULL</code></b> otherwise.
	 * </p>
	 * @var string
	 */
	public $version;


	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

/**
 * @link http://php.net/manual/en/class.domentityreference.php
 */
class DOMEntityReference extends DOMNode  {

	/**
	 * (PHP 5)<br/>
	 * Creates a new DOMEntityReference object
	 * @link http://php.net/manual/en/domentityreference.construct.php
	 * @param string $name <p>
	 * The name of the entity reference.
	 * </p>
	 */
	public function __construct ($name) {}

	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

/**
 * @link http://php.net/manual/en/class.domprocessinginstruction.php
 */
class DOMProcessingInstruction extends DOMNode  {
	/**
	 * <p></p>
	 * @var string
	 */
	public $target;
	/**
	 * <p></p>
	 * @var string
	 */
	public $data;


	/**
	 * (PHP 5)<br/>
	 * Creates a new <b>DOMProcessingInstruction</b> object
	 * @link http://php.net/manual/en/domprocessinginstruction.construct.php
	 * @param string $name <p>
	 * The tag name of the processing instruction.
	 * </p>
	 * @param string $value [optional] <p>
	 * The value of the processing instruction.
	 * </p>
	 */
	public function __construct ($name, $value = null) {}

	/**
	 * (PHP 5)<br/>
	 * Adds a new child before a reference node
	 * @link http://php.net/manual/en/domnode.insertbefore.php
	 * @param DOMNode $newnode <p>
	 * The new node.
	 * </p>
	 * @param DOMNode $refnode [optional] <p>
	 * The reference node. If not supplied, <i>newnode</i> is
	 * appended to the children.
	 * </p>
	 * @return DOMNode The inserted node.
	 */
	public function insertBefore (DOMNode $newnode, DOMNode $refnode = null) {}

	/**
	 * (PHP 5)<br/>
	 * Replaces a child
	 * @link http://php.net/manual/en/domnode.replacechild.php
	 * @param DOMNode $newnode <p>
	 * The new node. It must be a member of the target document, i.e.
	 * created by one of the DOMDocument->createXXX() methods or imported in
	 * the document by .
	 * </p>
	 * @param DOMNode $oldnode <p>
	 * The old node.
	 * </p>
	 * @return DOMNode The old node or <b>FALSE</b> if an error occur.
	 */
	public function replaceChild (DOMNode $newnode, DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Removes child from list of children
	 * @link http://php.net/manual/en/domnode.removechild.php
	 * @param DOMNode $oldnode <p>
	 * The removed child.
	 * </p>
	 * @return DOMNode If the child could be removed the function returns the old child.
	 */
	public function removeChild (DOMNode $oldnode) {}

	/**
	 * (PHP 5)<br/>
	 * Adds new child at the end of the children
	 * @link http://php.net/manual/en/domnode.appendchild.php
	 * @param DOMNode $newnode <p>
	 * The appended child.
	 * </p>
	 * @return DOMNode The node added.
	 */
	public function appendChild (DOMNode $newnode) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has children
	 * @link http://php.net/manual/en/domnode.haschildnodes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasChildNodes () {}

	/**
	 * (PHP 5)<br/>
	 * Clones a node
	 * @link http://php.net/manual/en/domnode.clonenode.php
	 * @param bool $deep [optional] <p>
	 * Indicates whether to copy all descendant nodes. This parameter is
	 * defaulted to <b>FALSE</b>.
	 * </p>
	 * @return DOMNode The cloned node.
	 */
	public function cloneNode ($deep = null) {}

	/**
	 * (PHP 5)<br/>
	 * Normalizes the node
	 * @link http://php.net/manual/en/domnode.normalize.php
	 * @return void No value is returned.
	 */
	public function normalize () {}

	/**
	 * (PHP 5)<br/>
	 * Checks if feature is supported for specified version
	 * @link http://php.net/manual/en/domnode.issupported.php
	 * @param string $feature <p>
	 * The feature to test. See the example of
	 * <b>DOMImplementation::hasFeature</b> for a
	 * list of features.
	 * </p>
	 * @param string $version <p>
	 * The version number of the <i>feature</i> to test.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSupported ($feature, $version) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if node has attributes
	 * @link http://php.net/manual/en/domnode.hasattributes.php
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function hasAttributes () {}

	/**
	 * @param DOMNode $other
	 */
	public function compareDocumentPosition (DOMNode $other) {}

	/**
	 * (PHP 5)<br/>
	 * Indicates if two nodes are the same node
	 * @link http://php.net/manual/en/domnode.issamenode.php
	 * @param DOMNode $node <p>
	 * The compared node.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function isSameNode (DOMNode $node) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace prefix of the node based on the namespace URI
	 * @link http://php.net/manual/en/domnode.lookupprefix.php
	 * @param string $namespaceURI <p>
	 * The namespace URI.
	 * </p>
	 * @return string The prefix of the namespace.
	 */
	public function lookupPrefix ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Checks if the specified namespaceURI is the default namespace or not
	 * @link http://php.net/manual/en/domnode.isdefaultnamespace.php
	 * @param string $namespaceURI <p>
	 * The namespace URI to look for.
	 * </p>
	 * @return bool Return <b>TRUE</b> if <i>namespaceURI</i> is the default
	 * namespace, <b>FALSE</b> otherwise.
	 */
	public function isDefaultNamespace ($namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Gets the namespace URI of the node based on the prefix
	 * @link http://php.net/manual/en/domnode.lookupnamespaceuri.php
	 * @param string $prefix <p>
	 * The prefix of the namespace.
	 * </p>
	 * @return string The namespace URI of the node.
	 */
	public function lookupNamespaceUri ($prefix) {}

	/**
	 * @param DOMNode $arg
	 */
	public function isEqualNode (DOMNode $arg) {}

	/**
	 * @param $feature
	 * @param $version
	 */
	public function getFeature ($feature, $version) {}

	/**
	 * @param $key
	 * @param $data
	 * @param $handler
	 */
	public function setUserData ($key, $data, $handler) {}

	/**
	 * @param $key
	 */
	public function getUserData ($key) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Get an XPath for a node
	 * @link http://php.net/manual/en/domnode.getnodepath.php
	 * @return string a string containing the XPath, or <b>NULL</b> in case of an error.
	 */
	public function getNodePath () {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Get line number for a node
	 * @link http://php.net/manual/en/domnode.getlineno.php
	 * @return int Always returns the line number where the node was defined in.
	 */
	public function getLineNo () {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a string
	 * @link http://php.net/manual/en/domnode.c14n.php
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return string canonicalized nodes as a string or <b>FALSE</b> on failure
	 */
	public function C14N ($exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

	/**
	 * (PHP 5 &gt;= 5.2.0)<br/>
	 * Canonicalize nodes to a file
	 * @link http://php.net/manual/en/domnode.c14nfile.php
	 * @param string $uri <p>
	 * Path to write the output to.
	 * </p>
	 * @param bool $exclusive [optional] <p>
	 * Enable exclusive parsing of only the nodes matched by the provided
	 * xpath or namespace prefixes.
	 * </p>
	 * @param bool $with_comments [optional] <p>
	 * Retain comments in output.
	 * </p>
	 * @param array $xpath [optional] <p>
	 * An array of xpaths to filter the nodes by.
	 * </p>
	 * @param array $ns_prefixes [optional] <p>
	 * An array of namespace prefixes to filter the nodes by.
	 * </p>
	 * @return int Number of bytes written or <b>FALSE</b> on failure
	 */
	public function C14NFile ($uri, $exclusive = null, $with_comments = null, array $xpath = null, array $ns_prefixes = null) {}

}

class DOMStringExtend  {

	/**
	 * @param $offset32
	 */
	public function findOffset16 ($offset32) {}

	/**
	 * @param $offset16
	 */
	public function findOffset32 ($offset16) {}

}

/**
 * Supports XPath 1.0
 * @link http://php.net/manual/en/class.domxpath.php
 */
class DOMXPath  {
	/**
	 * <p></p>
	 * @var DOMDocument
	 */
	public $document;


	/**
	 * (PHP 5)<br/>
	 * Creates a new <b>DOMXPath</b> object
	 * @link http://php.net/manual/en/domxpath.construct.php
	 * @param DOMDocument $doc <p>
	 * The <b>DOMDocument</b> associated with the
	 * <b>DOMXPath</b>.
	 * </p>
	 */
	public function __construct (DOMDocument $doc) {}

	/**
	 * (PHP 5)<br/>
	 * Registers the namespace with the <b>DOMXPath</b> object
	 * @link http://php.net/manual/en/domxpath.registernamespace.php
	 * @param string $prefix <p>
	 * The prefix.
	 * </p>
	 * @param string $namespaceURI <p>
	 * The URI of the namespace.
	 * </p>
	 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
	 */
	public function registerNamespace ($prefix, $namespaceURI) {}

	/**
	 * (PHP 5)<br/>
	 * Evaluates the given XPath expression
	 * @link http://php.net/manual/en/domxpath.query.php
	 * @param string $expression <p>
	 * The XPath expression to execute.
	 * </p>
	 * @param DOMNode $contextnode [optional] <p>
	 * The optional <i>contextnode</i> can be specified for
	 * doing relative XPath queries. By default, the queries are relative to
	 * the root element.
	 * </p>
	 * @param bool $registerNodeNS [optional] <p>
	 * The optional <i>registerNodeNS</i> can be specified to
	 * disable automatic registration of the context node.
	 * </p>
	 * @return DOMNodeList a <b>DOMNodeList</b> containing all nodes matching
	 * the given XPath <i>expression</i>. Any expression which
	 * does not return nodes will return an empty
	 * <b>DOMNodeList</b>.
	 * </p>
	 * <p>
	 * If the <i>expression</i> is malformed or the
	 * <i>contextnode</i> is invalid,
	 * <b>DOMXPath::query</b> returns <b>FALSE</b>.
	 */
	public function query ($expression, DOMNode $contextnode = null, $registerNodeNS = true) {}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Evaluates the given XPath expression and returns a typed result if possible
	 * @link http://php.net/manual/en/domxpath.evaluate.php
	 * @param string $expression <p>
	 * The XPath expression to execute.
	 * </p>
	 * @param DOMNode $contextnode [optional] <p>
	 * The optional <i>contextnode</i> can be specified for
	 * doing relative XPath queries. By default, the queries are relative to
	 * the root element.
	 * </p>
	 * @param bool $registerNodeNS [optional] <p>
	 * The optional <i>registerNodeNS</i> can be specified to
	 * disable automatic registration of the context node.
	 * </p>
	 * @return mixed a typed result if possible or a <b>DOMNodeList</b>
	 * containing all nodes matching the given XPath <i>expression</i>.
	 * </p>
	 * <p>
	 * If the <i>expression</i> is malformed or the
	 * <i>contextnode</i> is invalid,
	 * <b>DOMXPath::evaluate</b> returns <b>FALSE</b>.
	 */
	public function evaluate ($expression, DOMNode $contextnode = null, $registerNodeNS = true) {}

	/**
	 * (PHP 5 &gt;= 5.3.0)<br/>
	 * Register PHP functions as XPath functions
	 * @link http://php.net/manual/en/domxpath.registerphpfunctions.php
	 * @param mixed $restrict [optional] <p>
	 * Use this parameter to only allow certain functions to be called from XPath.
	 * </p>
	 * <p>
	 * This parameter can be either a string (a function name) or
	 * an array of function names.
	 * </p>
	 * @return void No value is returned.
	 */
	public function registerPhpFunctions ($restrict = null) {}

}

/**
 * (PHP 5)<br/>
 * Gets a <b>DOMElement</b> object from a
<b>SimpleXMLElement</b> object
 * @link http://php.net/manual/en/function.dom-import-simplexml.php
 * @param SimpleXMLElement $node <p>
 * The <b>SimpleXMLElement</b> node.
 * </p>
 * @return DOMElement The <b>DOMElement</b> node added or <b>FALSE</b> if any errors occur.
 */
function dom_import_simplexml (SimpleXMLElement $node) {}


/**
 * Node is a <b>DOMElement</b>
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('XML_ELEMENT_NODE', 1);

/**
 * Node is a <b>DOMAttr</b>
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('XML_ATTRIBUTE_NODE', 2);

/**
 * Node is a <b>DOMText</b>
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('XML_TEXT_NODE', 3);

/**
 * Node is a <b>DOMCharacterData</b>
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('XML_CDATA_SECTION_NODE', 4);

/**
 * Node is a <b>DOMEntityReference</b>
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('XML_ENTITY_REF_NODE', 5);

/**
 * Node is a <b>DOMEntity</b>
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('XML_ENTITY_NODE', 6);

/**
 * Node is a <b>DOMProcessingInstruction</b>
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('XML_PI_NODE', 7);

/**
 * Node is a <b>DOMComment</b>
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('XML_COMMENT_NODE', 8);

/**
 * Node is a <b>DOMDocument</b>
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('XML_DOCUMENT_NODE', 9);

/**
 * Node is a <b>DOMDocumentType</b>
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('XML_DOCUMENT_TYPE_NODE', 10);

/**
 * Node is a <b>DOMDocumentFragment</b>
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('XML_DOCUMENT_FRAG_NODE', 11);

/**
 * Node is a <b>DOMNotation</b>
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('XML_NOTATION_NODE', 12);
define ('XML_HTML_DOCUMENT_NODE', 13);
define ('XML_DTD_NODE', 14);
define ('XML_ELEMENT_DECL_NODE', 15);
define ('XML_ATTRIBUTE_DECL_NODE', 16);
define ('XML_ENTITY_DECL_NODE', 17);
define ('XML_NAMESPACE_DECL_NODE', 18);
define ('XML_LOCAL_NAMESPACE', 18);
define ('XML_ATTRIBUTE_CDATA', 1);
define ('XML_ATTRIBUTE_ID', 2);
define ('XML_ATTRIBUTE_IDREF', 3);
define ('XML_ATTRIBUTE_IDREFS', 4);
define ('XML_ATTRIBUTE_ENTITY', 6);
define ('XML_ATTRIBUTE_NMTOKEN', 7);
define ('XML_ATTRIBUTE_NMTOKENS', 8);
define ('XML_ATTRIBUTE_ENUMERATION', 9);
define ('XML_ATTRIBUTE_NOTATION', 10);

/**
 * Error code not part of the DOM specification. Meant for PHP errors.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_PHP_ERR', 0);

/**
 * If index or size is negative, or greater than the allowed value.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_INDEX_SIZE_ERR', 1);

/**
 * If the specified range of text does not fit into a
 * <b>DOMString</b>.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOMSTRING_SIZE_ERR', 2);

/**
 * If any node is inserted somewhere it doesn't belong
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_HIERARCHY_REQUEST_ERR', 3);

/**
 * If a node is used in a different document than the one that created it.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_WRONG_DOCUMENT_ERR', 4);

/**
 * If an invalid or illegal character is specified, such as in a name.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_INVALID_CHARACTER_ERR', 5);

/**
 * If data is specified for a node which does not support data.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_NO_DATA_ALLOWED_ERR', 6);

/**
 * If an attempt is made to modify an object where modifications are not allowed.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_NO_MODIFICATION_ALLOWED_ERR', 7);

/**
 * If an attempt is made to reference a node in a context where it does not exist.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_NOT_FOUND_ERR', 8);

/**
 * If the implementation does not support the requested type of object or operation.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_NOT_SUPPORTED_ERR', 9);

/**
 * If an attempt is made to add an attribute that is already in use elsewhere.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_INUSE_ATTRIBUTE_ERR', 10);

/**
 * If an attempt is made to use an object that is not, or is no longer, usable.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_INVALID_STATE_ERR', 11);

/**
 * If an invalid or illegal string is specified.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_SYNTAX_ERR', 12);

/**
 * If an attempt is made to modify the type of the underlying object.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_INVALID_MODIFICATION_ERR', 13);

/**
 * If an attempt is made to create or change an object in a way which is
 * incorrect with regard to namespaces.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_NAMESPACE_ERR', 14);

/**
 * If a parameter or an operation is not supported by the underlying object.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_INVALID_ACCESS_ERR', 15);

/**
 * If a call to a method such as insertBefore or removeChild would make the Node
 * invalid with respect to "partial validity", this exception would be raised and
 * the operation would not be done.
 * @link http://php.net/manual/en/dom.constants.php
 */
define ('DOM_VALIDATION_ERR', 16);

// End of dom v.20031129
?>
