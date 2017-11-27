<? if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/**
 * Class Ci_easyxml.
 *
 * This class is an abstraction layer between controllers and
 * XML files. This class has the aim to behave like CodeIgniter
 * DAO models.
 *
 * @author Carlos Eduardo da Silva <carlosedasilva@gmail.com>
 * @package libraries
 * @link http://blog.tetranet.com.br/category/php/codeigniter/
 * @version 1.0
 *
 * @todo Make this class generic. The specific data related to
 * a XML file should be inside models no here. Next versions of
 * of this class the DAO and VO classes should be inside models
 * folder and this class have to be instantiated inside the model
 * files not directly from controllers.
 */
class Ci_easyxml
{
 
 private $xml = null;
 private $path = null;
 
 /**
 * Constructor
 *
 * Constructor to validate the environment and load the xml file.
 *
 * @access public
 * @param mixed $params path = '/database/db_test.xml'
 */
 function __construct( $params )
 {
 if ( file_exists ( $params ['path'] ))
 {
 if( extension_loaded('simplexml') )
 {
 if( is_writable($params ['path']) )
 {
 $this->path = $params ['path'];
 
 if( ! $this->xml = simplexml_load_file( $params ['path'], 'SimpleXMLExtended' ) )
 {
 // Problems <img src="http://blog.tetranet.com.br/wp-includes/images/smilies/frownie.png" alt=":(" class="wp-smiley" style="height: 1em; max-height: 1em;">
 show_error('Error reading '.basename( $params ['path'] ).' file.');
 }
 }
 else
 {
 // Problems <img src="http://blog.tetranet.com.br/wp-includes/images/smilies/frownie.png" alt=":(" class="wp-smiley" style="height: 1em; max-height: 1em;">
 show_error('The file '.basename( $params ['path'] ).' is not writable! Check the permissions.');
 }
 }
 else
 {
 // Problems <img src="http://blog.tetranet.com.br/wp-includes/images/smilies/frownie.png" alt=":(" class="wp-smiley" style="height: 1em; max-height: 1em;">
 show_error('SimpleXML is not loaded! Check the loaded modules you have: <pre>' .
 var_export( get_loaded_extensions(), true ) . '</pre>' );
 }
 }
 else
 {
 // Problems <img src="http://blog.tetranet.com.br/wp-includes/images/smilies/frownie.png" alt=":(" class="wp-smiley" style="height: 1em; max-height: 1em;">
 show_error('Some featutres of EasyXML wont work, because the XML file does\'t exist!
 Check the path you informed: ' . $params ['path'] );
 }
 }
 
 /**
 * Get Num Elements
 *
 * Return the number of nodes in XML file.
 *
 * @access public
 * @return int The number of elements.
 *
 * @example $this->ci_easyxml->get_num_elements();
 */
 public function get_num_elements()
 {
 $count = 0;
 
 foreach ( $this->xml as $node )
 {
 $count ++;
 }
 
 return $count;
 }
 
 /**
 * Child Exists
 *
 * Check if a particular child exists in the xml file.
 *
 * @access public
 * @param string $childpath Name of the child node.
 *
 * @return mixed If true return the number of childs or else return false.
 *
 * @example $this->ci_easyxml->child_exists('/catalog/book/author');
 */
 public function child_exists( $childpath )
 {
 $result = $this->xml->xpath($childpath);
 
 return count( $result ) ? $result : false;
 }
 
 /**
 * Attribute Value Exists
 *
 * Check if a certain value of an attribute exists in XML file.
 *
 * @access public
 * @param string $childpath Name of the node.
 * @param string $attribute Name of the vaule.
 * @param string $atribvalue Value of the attribute.
 *
 * @return mixed If true return the number of values or else return false.
 *
 * @example $this->ci_easyxml->attribute_value_exists('/catalog/book','id','bk103');
 */
 public function attribute_value_exists( $childpath, $attribute, $atribvalue )
 {
 $xpath_val = "//".$childpath."[@".$attribute."='".$atribvalue."']";
 $res = $this->xml->xpath( $xpath_val );
 
 return count( $res ) ? $res : false;
 }
 
 /**
 * Remove Node By Attribute
 *
 * Remove a node from xml file by its attribute.
 *
 * @access public
 * @param string $nodename Name of the node.
 * @param string $attribute Name of the value.
 * @param string $value Value of the attribute.
 *
 * @return boolean TRUE: Delete success. FALSE: Delete errror.
 *
 * @example $this->ci_easyxml->removeNodeByAttrib('book','id','bk113');
 */
 public function removeNodeByAttrib( $nodename, $attribute, $value )
 {
 if( $this->attribute_value_exists('/catalog/'.$nodename, $attribute, $value) )
 {
 $xpath_val = "//".$nodename."[@".$attribute."='".$value."']";
 $res = $this->xml->xpath($xpath_val);
 
 foreach( $res as $key => $node )
 {
 foreach( $node->attributes() as $attrib => $val )
 {
 if( ($attrib == $attribute) && ($val == $value) )
 {
 $oNode = dom_import_simplexml( $node );
 }
 }
 }
 $oNode->parentNode->removeChild( $oNode );
 $this->xml->saveXMLIndented( $this->xml, $this->path );
 return TRUE;
 }
 else
 {
 return FALSE;
 }
 }
 
 /**
 * Force conversion from ISO8859-1 to UTF-8.
 *
 * It's a problem for non-english websites/systems to handle XML in
 * other languages. So this method tries to give a hand converting
 * texts in iso8859-1 to UTF-8.
 *
 * @access private
 * @param string $text The text to be converted.
 *
 * @return string The string in UTF-8 encode.
 *
 * @example $content = $this->forceIso8859toUTF8( $content );
 */
 private function forceIso8859toUTF8( $text )
 {
 return iconv( "ISO-8859-1", "UTF-8//TRANSLIT", $text );
 }
 
 /**
 * Get Max Attribute
 *
 * Returns the maximum value of an attribute.
 *
 * @access private
 * @param string $childpath Name of the node.
 * @param string $attribute Name of the attribute.
 *
 * @return mixed The maximum value of an attribute.
 *
 * @example $this->get_max_attribute('/catalog/book','id');
 */
 private function get_max_attribute( $childpath, $attribute)
 {
 $xpath_val = "//".$childpath."[@".$attribute."]";
 $res = $this->xml->xpath( $xpath_val );
 
 foreach( $res as $key => $node )
 {
 foreach( $node->attributes() as $attrib => $val )
 {
 if( ($attrib == $attribute) )
 {
 $arr[] = preg_replace("/[^0-9]/","", $val);
 }
 }
 }
 
 return max($arr);
 }
 
 /**
 * Insert Book
 *
 * Inserts a new book node in xml file.
 *
 * @param array $data Book information.
 * @return int The Id of inserted book.
 *
 * @example $this->ci_easyxml->insert_book($arrayChildNodes);
 */
 public function insert_book( $data )
 {
 $book = $this->xml->addChild('book');
 $last_id = $this->get_max_attribute('/catalog/book','id') + 1;
 $last_id = 'bk'.$last_id;
 
 $book->addAttribute('id', $last_id);
 
 foreach($data as $key => $value)
 {
 $book->addChild($key,$value);
 }
 
 $this->xml->saveXMLIndented( $this->xml, $this->path );
 
 return $last_id; #returning last id
 }
 
 /**
 * Update Book
 *
 * Update a book node.
 *
 * @param array $data Book information, including its Id.
 * @return boolean TRUE: Success. FALSE: Error.
 *
 * @example $this->ci_easyxml->update_book($arrayChildNodes);
 */
 public function update_book( $data )
 {
 $res = $this->attribute_value_exists( "book", "id", $data['id'] );
 
 if( $res )
 {
 $res[0]->author = $data['author'];
 $res[0]->title = $data['title'];
 $res[0]->genre = $data['genre'];
 $res[0]->price = $data['price'];
 $res[0]->publish_date = $data['publish_date'];
 $res[0]->description = $data['description'];
 
 $this->xml->saveXMLIndented( $this->xml,$this->path );
 
 return TRUE;
 }
 else
 {
 return FALSE;
 }
 }
 
 /**
 * Ensures UTF-8
 *
 * Method to ensure if a string is in UTF-8.
 *
 * @param string $string A text to be verified.
 * @return string The text in UTF-8.
 */
 private function ensureUTF8($string)
 {
 $encoding = mb_detect_encoding($string);
 
 if($encoding != 'UTF-8')
 {
 return iconv($encoding, 'UTF-8//TRANSLIT', $string);
 }
 else
 {
 return $string;
 }
 }
 
} // end_class
 
/**
 * SimpleXMLExtended
 *
 * Adding extra spice in PHP SimpleXML.
 *
 * @author Carlos
 */
class SimpleXMLExtended extends SimpleXMLElement
{
 /**
 * Add CData
 *
 * Adds Cdata in XML, useful if your string contains HTML tags.
 *
 * @param string $cdata_text String containing html tags.
 *
 * @example $my_child = $item->addChild ( 'foo' );
 * $my_child->addCData( '<strong><u>Hello World!!</u></strong>' );
 */
 public function addCData($cdata_text)
 {
 $node = dom_import_simplexml ( $this );
 $no = $node->ownerDocument;
 
 $node->appendChild ( $no->createCDATASection ( $cdata_text ) );
 }
 
 /**
 * Saves a XML Indented file.
 *
 * Saves an indented XML file.
 *
 * @param object $xml XML object.
 * @param string $path XML path in file system.
 *
 * @example $this->xml->saveXMLIndented( $this->xml,$this->path );
 */
 public function saveXMLIndented( $xml, $path = "" )
 {
 $doc = new DOMDocument ( '1.0' );
 
 $doc->preserveWhiteSpace = false;
 $doc->loadXML ( $xml->asXML() );
 $doc->formatOutput = true;
 
 if( $path == "" )
 {
 echo $doc->saveXML();
 }
 else
 {
 file_put_contents( $path, $doc->saveXML());
 }
 }
} //end_class
#EOF