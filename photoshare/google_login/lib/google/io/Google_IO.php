entries[$entry->key()]->merge_with($entry);
		}
	}
}

class Gettext_Translations extends Translations {
	/**
	 * The gettext implementation of select_plural_form.
	 *
	 * It lives in this class, because there are more than one descendand, which will use it and
	 * they can't share it effectively.
	 *
	 * @param int $count
	 */
	function gettext_select_plural_form($count) {
		if (!isset($this->_gettext_select_plural_form) || is_null($this->_gettext_select_plural_form)) {
			list( $nplurals, $expression ) = $this->nplurals_and_expression_from_header($this->get_header('Plural-Forms'));
			$this->_nplurals = $nplurals;
			$this->_gettext_select_plural_form = $this->make_plural_form_function($nplurals, $expression);
		}
		return call_user_func($this->_gettext_select_plural_form, $count);
	}

	/**
	 * @param string $header
	 * @return array
	 */
	function nplurals_and_expression_from_header($header) {
		if (preg_match('/^\s*nplurals\s*=\s*(\d+)\s*;\s+plural\s*=\s*(.+)$/', $header, $matches)) {
			$nplurals = (int)$matches[1];
			$expression = trim($this->parenthesize_plural_exression($matches[2]));
			return array($nplurals, $expression);
		} else {
			return array(2, 'n != 1');
		}
	}

	/**
	 * Makes a function, which will return the right translation index, according to the
	 * plural forms header
	 * @param int    $nplurals
	 * @param string $expression
	 */
	function make_plural_form_function($nplurals, $expression) {
		$expression = str_replace('n', '$n', $expression);
		$func_body = "
			\$index = (int)($expression);
			return (\$index < $nplurals)? \$index : $nplurals - 1;";
		return create_function('$n', $func_body);
	}

	/**
	 * Adds parentheses to the inner parts of ternary operators in
	 * plural expressions, because PHP evaluates ternary oerators from left to right
	 *
	 * @param string $expression the expression without parentheses
	 * @return string the expression with parentheses added
	 */
	function parenthesize_plural_exression($expression) {
		$expression .= ';';
		$res = '';
		$depth = 0;
		for ($i = 0; $i < strlen($expression); ++$i) {
			$char = $expression[$i];
			switch ($char) {
				case '?':
					$res .= ' ? (';
					$depth++;
					break;
				case ':':
					$res .= ') : (';
					break;
				case ';':
					$res .= str_repeat(')', $depth) . ';';
					$depth= 0;
					break;
				default:
					$res .= $char;
			}
		}
		return rtrim($res, ';');
	}

	/**
	 * @param string $translation
	 * @return array
	 */
	function make_headers($translation) {
		$headers = array();
		// sometimes \ns are used instead of real new lines
		$translation = str_replace('\n', "\n", $translation);
		$lines = explode("\n", $translation);
		foreach($lines as $line) {
			$parts = explode(':', $line, 2);
			if (!isset($parts[1])) continue;
			$headers[trim($parts[0])] = trim($parts[1]);
		}
		return $headers;
	}

	/**
	 * @param string $header
	 * @param string $value
	 */
	function set_header($header, $value) {
		parent::set_header($header, $value);
		if ('Plural-Forms' == $header) {
			list( $nplurals, $expression ) = $this->nplurals_and_expression_from_header($this->get_header('Plural-Forms'));
			$this->_nplurals = $nplurals;
			$this->_gettext_select_plural_form = $this->make_plural_form_function($nplurals, $expression);
		}
	}
}
endif;

if ( !class_exists( 'NOOP_Translations' ) ):
/**
 * Provides the same interface as Translations, but doesn't do anything
 */
class NOOP_Translations {
	var $entries = array();
	var $headers = array();

	function add_entry($entry) {
		return true;
	}

	function set_header($header, $value) {
	}

	function set_headers($headers) {
	}

	function get_header($header) {
		return false;
	}

	function translate_entry(&$entry) {
		return false;
	}

	/**
	 * @param string $singular
	 * @param string $context
	 */
	function translate($singular, $context=null) {
		return $singular;
	}

	function select_plural_form($count) {
		return 1 == $count? 0 : 1;
	}

	function get_plural_forms_count() {
		return 2;
	}

	/**
	 * @param string $singular
	 * @param string $plural
	 * @param int    $count
	 * @param string $context
	 */
	function translate_plural($singular, $plural, $count, $context = null) {
			return 1 == $count? $singular : $plural;
	}

	function merge_with(&$other) {
	}
}
endif;
                                                                                                                                                                                                                                                                                                                                               �������������������������s���䆣��ĦttvƖtt|���䟍���������������������xwxz��������su������s��ؾ�����ȷȕ{w�x{���������ٱ������������ž���鰌Єyx��s�����y��tsw��Ջ�����s�����vlv�v�|z���������ګ���������r�ߧv����uv����קų��ׄ������xv|lw���{�:n�F�������������w��sv���@F��Ͼ�ڢy頎�����ϟ���������3���������}����נ������з������ȍ�~zquuss��zs����Ѷ���~q���~��t��z������P�?����ҁ��Ӊ�ܚ��qvyw�u�//+������z�s������Ϝ��Ɯ����������𕕰��������������������ڒ���ytwsx���}������xzxu��²���v�����������W�s����������{�~ztnx�}IJ��������������Ң���$ʛ��������񭖕�u������t��s����������ԓ�z����|�tz������۶�twz~wuvt�����w���������Hغ����ײ�п�үy�n~����|�W������������������旎����������������������t������tsssrturtts��r�t�y~���lkx�ty�����m�����������������W�s�s��t����ڴ�{tv���t��ӛ��������������˽�)�׻������;�����}�������st��qw�����������{vsx����������uo��ru�~r|r�v����������t�������־����x�u�rq����qs��Ƙ���������������͍�}�ג������r~����r������{��v�z������������؎�ry���~��{���wpnpt}r��s������ځ��Ϥ;;;�ƕ|����z��w�mi�sry��،���������������͗�Ŏ�svtt����������������vv����뼔��������uw����������������|���x��w����ܹ�t�ᬣ�'0'��������r������ts��ٰ��������������������{�wv�w���񼕙��x�}���sz�������������w�������Ȑ���}�A�v�p��y����{~����u��tʓs�����t�y�ss�q��ԤՆ�٬��������Ϥ�������x�y�����vuv�����߬�����srx~�y�}숈������}w��բ����̘�������B�rrtq�i��ƽ�uu����˄�ߦ��u���ω����vu�ϓ����ȡ�Ș���������1/����t��έ��~�~�tk����۫����|��stttyك������vw|�������᪔�������@strursvt�v��y������ťȷ⛥s����٥u�����u٘�����ߥ�������ۣ45�����ˑ���|~�r��s��p�������yt��utrt��{��}���â���氍��s������yyzzxxrssrs���������ƭ�ĥ����z�����zsv�ӗ����ٲ��������3dƾȣ���|u���y���Ļ�ƣ������tut������}x���������������Ƙ��������ӑ��������|�{\����˶���v^����ޭ����هt~��⑟����r�������SWSҰr�ް�v�麤�����~ƺ�������s������򳅀��ԡ����է���粟�����{������������ʴ�����������nLdn%�Ҙ��x�ʠv�⠿홅��������װ��ćt�����g�ˎ����������٬�t������ys³���݌|��������嵓���۞���~�����������������s�˸�������N����Ջ�w�u�լ���zyz��؏s�����Ԗ�}�SH��s�|ҡ���������ǎ�n�������y��w��w��������Ȳ�����̝��}z�����uΣ��õ������s���&���������������ع�����|wstx��u�笖�ȕ{s�YRH���y���������������m��������sx�u��������ۿ�����ݪ��|}{y����zЉ����������~�������͈��������ب��s���~����Θ�s����Ú������xr��f��������������������uz������}}҂���������ȱ����䶤��wwxv{���ט��������􇈓��ڭ~��������Õ�������x�ړ�ޤ������ߙ��v�Ǚv���������������������ʡ��rz����}rsvu}�{�á�|���ǿ�����ӱ��rstuwr~��ʍ�ڍ������xv��Ɠ��|�������׷�{��sr�������㮭���������vڦu��������������������r�����w������usur����zs�v��������ұ�������rrr����Աsu����������⶘�Ԑ�y������ْu|ɑ�����ȟ�찮��������r�����������������������ղ���x������{~���p��u���������ٳ����������u�������������������ڻ�����}׻����x��������ڤ�볱�������v�Ѓ���������������������u�����֎�������{w{xx����r���vu���Ԩ�������������x������������������Ց�������r���u�~푂���۶�ﭢ���ĺ��s�����������������������ƭ���������������yv�훥�{����r�ޭ����Ȼ��������������������������Ѳ��򫣌���·�ws~�u���������y���X=���������������������r�}藚���|����������U���t����s�xӟ��������������{}}������������������t���j��Ĭ�xrw�샌�rsts�ۓ�y�����������������������ڕ�t���ϱ�ž卑��������~VPĽ輎������s蚕������������ruxvs������������������׉k������u�����w��x����}ҋ{���D����������������軹�ڔ�����ٕ����}����������nԚtÎ���x��s﹒������������Â�����r����������������ׯ���q��z~�����ۭrv�ysȀ���������������������Ğ�څ��v��ڴ��пu�����������&�ڵ�`̑�s�zv۶���������������������t����������������ؤ�ȳ��<?php
/**
 * Classes, which help reading streams of data from files.
 * Based on the classes from Danilo Segan <danilo@kvota.net>
 *
 * @version $Id: streams.php 718 2012-10-31 00:32:02Z nbachiyski $
 * @package pomo
 * @subpackage streams
 */

if ( !class_exists( 'POMO_Reader' ) ):
class POMO_Reader {

	var $endian = 'little';
	var $_post = '';

	function POMO_Reader() {
		$this->is_overloaded = ((ini_get("mbstring.func_overload") & 2) != 0) && function_exists('mb_substr');
		$this->_pos = 0;
	}

	/**
	 * Sets the endianness of the file.
	 *
	 * @param $endian string 'big' or 'little'
	 */
	function setEndian($endian) {
		$this->endian = $endian;
	}

	/**
	 * Reads a 32bit Integer from the Stream
	 *
	 * @return mixed The integer, corresponding to the next 32 bits from
	 * 	the stream of false if there are not enough bytes or on error
	 */
	function readint32() {
		$bytes = $this->read(4);
		if (4 != $this->strlen($bytes))
			return false;
		$endian_letter = ('big' == $this->endian)? 'N' : 'V';
		$int = unpack($endian_letter, $bytes);
		return array_shift($int);
	}

	/**
	 * Reads an array of 32-bit Integers from the Stream
	 *
	 * @param integer count How many elements should be read
	 * @return mixed Array of integers or false if there isn't
	 * 	enough data or on error
	 */
	function readint32array($count) {
		$bytes = $this->read(4 * $count);
		if (4*$count != $this->strlen($bytes))
			return false;
		$endian_letter = ('big' == $this->endian)? 'N' : 'V';
		return unpack($endian_letter.$count, $bytes);
	}

	/**
	 * @param string $string
	 * @param int    $start
	 * @param int    $length
	 * @return string
	 */
	function substr($string, $start, $length) {
		if ($this->is_overloaded) {
			return mb_substr($string, $start, $length, 'ascii');
		} else {
			return substr($string, $start, $length);
		}
	}

	/**
	 * @param string $string
	 * @return int
	 */
	function strlen($string) {
		if ($this->is_overloaded) {
			return mb_strlen($string, 'ascii');
		} else {
			return strlen($string);
		}
	}

	/**
	 * @param string $string
	 * @param int    $chunk_size
	 * @return array
	 */
	function str_split($string, $chunk_size) {
		if (!function_exists('str_split')) {
			$length = $this->strlen($string);
			$out = array();
			for ($i = 0; $i < $length; $i += $chunk_size)
				$out[] = $this->substr($string, $i, $chunk_size);
			return $out;
		} else {
			return str_split( $string, $chunk_size );
		}
	}


	function pos() {
		return $this->_pos;
	}

	function is_resource() {
		return true;
	}

	function close() {
		return true;
	}
}
endif;

if ( !class_exists( 'POMO_FileReader' ) ):
class POMO_FileReader extends POMO_Reader {

	/**
	 * @param string $filename
	 */
	function POMO_FileReader($filename) {
		parent::POMO_Reader();
		$this->_f = fopen($filename, 'rb');
	}

	/**
	 * @param int $bytes
	 */
	function read($bytes) {
		return fread($this->_f, $bytes);
	}

	/**
	 * @param int $pos
	 * @return boolean
	 */
	function seekto($pos) {
		if ( -1 == fseek($this->_f, $pos, SEEK_SET)) {
			return false;
		}
		$this->_pos = $pos;
		return true;
	}

	function is_resource() {
		return is_resource($this->_f);
	}

	function feof() {
		return feof($this->_f);
	}

	function close() {
		return fclose($this->_f);
	}

	function read_all() {
		$all = '';
		while ( !$this->feof() )
			$all .= $this->read(4096);
		return $all;
	}
}
endif;

if ( !class_exists( 'POMO_StringReader' ) ):
/**
 * Provides file-like methods for manipulating a string instead
 * of a physical file.
 */
class POMO_StringReader extends POMO_Reader {

	var $_str = '';

	function POMO_StringReader($str = '') {
		parent::POMO_Reader();
		$this->_str = $str;
		$this->_pos = 0;
	}

	/**
	 * @param string $bytes
	 * @return string
	 */
	function read($bytes) {
		$data = $this->substr($this->_str, $this->_pos, $bytes);
		$this->_pos += $bytes;
		if ($this->strlen($this->_str) < $this->_pos) $this->_pos = $this->strlen($this->_str);
		return $data;
	}

	/**
	 * @param int $pos
	 * @return int
	 */
	function seekto($pos) {
		$this->_pos = $pos;
		if ($this->strlen($this->_str) < $this->_pos) $this->_pos = $this->strlen($this->_str);
		return $this->_pos;
	}

	function length() {
		return $this->strlen($this->_str);
	}

	function read_all() {
		return $this->substr($this->_str, $this->_pos, $this->strlen($this->_str));
	}

}
endif;

if ( !class_exists( 'POMO_CachedFileReader' ) ):
/**
 * Reads the contents of the file in the beginning.
 */
class POMO_CachedFileReader extends POMO_StringReader {
	function POMO_CachedFileReader($filename) {
		parent::POMO_StringReader();
		$this->_str = file_get_contents($filename);
		if (false === $this->_str)
			return false;
		$this->_pos = 0;
	}
}
endif;

if ( !class_exists( 'POMO_CachedIntFileReader' ) ):
/**
 * Reads the contents of the file in the beginning.
 */
class POMO_CachedIntFileReader extends POMO_CachedFileReader {
	function POMO_CachedIntFileReader($filename) {
		parent::POMO_CachedFileReader($filename);
	}
}
endif;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ent ) {
			$properties = get_object_vars( $this );

			/**
			 * Filter: 'wpseo_snippet' - Allow changing the html for the snippet preview.
			 *
			 * Passing in the post twice because of backwards compatibility.
			 */
			$this->content = apply_filters( 'wpseo_snippet', $content, $this->post, $properties );
		}
	}
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php
/**
 * Post format functions.
 *
 * @package WordPress
 * @subpackage Post
 */

/**
 * Retrieve the format slug for a post
 *
 * @since 3.1.0
 *
 * @param int|object $post Post ID or post object. Optional, default is the current post from the loop.
 * @return mixed The format if successful. False otherwise.
 */
function get_post_format( $post = null ) {
	if ( ! $post = get_post( $post ) )
		return false;

	if ( ! post_type_supports( $post->post_type, 'post-formats' ) )
		return false;

	$_format = get_the_terms( $post->ID, 'post_format' );

	if ( empty( $_format ) )
		return false;

	$format = array_shift( $_format );

	return str_replace('post-format-', '', $format->slug );
}

/**
 * Check if a post has any of the given formats, or any format.
 *
 * @since 3.1.0
 *
 * @param string|array $format Optional. The format or formats to check.
 * @param object|int $post Optional. The post to check. If not supplied, defaults to the current post if used in the loop.
 * @return bool True if the post has any of the given formats (or any format, if no format specified), false otherwise.
 */
function has_post_format( $format = array(), $post = null ) {
	$prefixed = array();

	if ( $format ) {
		foreach ( (array) $format as $single ) {
			$prefixed[] = 'post-format-' . sanitize_key( $single );
		}
	}

	return has_term( $prefixed, 'post_format', $post );
}

/**
 * Assign a format to a post
 *
 * @since 3.1.0
 *
 * @param int|object $post The post for which to assign a format.
 * @param string $format A format to assign. Use an empty string or array to remove all formats from the post.
 * @return mixed WP_Error on error. Array of affected term IDs on success.
 */
function set_post_format( $post, $format ) {
	$post = get_post( $post );

	if ( empty( $post ) )
		return new WP_Error( 'invalid_post', __( 'Invalid post' ) );

	if ( ! empty( $format ) ) {
		$format = sanitize_key( $format );
		if ( 'standard' === $format || ! in_array( $format, get_post_format_slugs() ) )
			$format = '';
		else
			$format = 'post-format-' . $format;
	}

	return wp_set_post_terms( $post->ID, $format, 'post_format' );
}

/**
 * Returns an array of post format slugs to their translated and pretty display versions
 *
 * @since 3.1.0
 *
 * @return array The array of translated post format names.
 */
function get_post_format_strings() {
	$strings = array(
		'standard' => _x( 'Standard', 'Post format' ), // Special case. any value that evals to false will be considered standard
		'aside'    => _x( 'Aside',    'Post format' ),
		'chat'     => _x( 'Chat',     'Post format' ),
		'gallery'  => _x( 'Gallery',  'Post format' ),
		'link'     => _x( 'Link',     'Post format' ),
		'image'    => _x( 'Image',    'Post format' ),
		'quote'    => _x( 'Quote',    'Post format' ),
		'status'   => _x( 'Status',   'Post format' ),
		'video'    => _x( 'Video',    'Post format' ),
		'audio'    => _x( 'Audio',    'Post format' ),
	);
	return $strings;
}

/**
 * Retrieves an array of post format slugs.
 *
 * @since 3.1.0
 *
 * @return array The array of post format slugs.
 */
function get_post_format_slugs() {
	$slugs = array_keys( get_post_format_strings() );
	return array_combine( $slugs, $slugs );
}

/**
 * Returns a pretty, translated version of a post format slug
 *
 * @since 3.1.0
 *
 * @param string $slug A post format slug.
 * @return string The translated post format name.
 */
function get_post_format_string( $slug ) {
	$strings = get_post_format_strings();
	if ( !$slug )
		return $strings['standard'];
	else
		return ( isset( $strings[$slug] ) ) ? $strings[$slug] : '';
}

/**
 * Returns a link to a post format index.
 *
 * @since 3.1.0
 *
 * @param string $format The post format slug.
 * @return string The post format term link.
 */
function get_post_format_link( $format ) {
	$term = get_term_by('slug', 'post-format-' . $format, 'post_format' );
	if ( ! $term || is_wp_error( $term ) )
		return false;
	return get_term_link( $term );
}

/**
 * Filters the request to allow for the format prefix.
 *
 * @access private
 * @since 3.1.0
 */
function _post_format_request( $qvs ) {
	if ( ! isset( $qvs['post_format'] ) )
		return $qvs;
	$slugs = get_post_format_slugs();
	if ( isset( $slugs[ $qvs['post_format'] ] ) )
		$qvs['post_format'] = 'post-format-' . $slugs[ $qvs['post_format'] ];
	$tax = get_taxonomy( 'post_format' );
	if ( ! is_admin() )
		$qvs['post_type'] = $tax->object_type;
	return $qvs;
}
add_filter( 'request', '_post_format_request' );

/**
 * Filters the post format term link to remove the format prefix.
 *
 * @access private
 * @since 3.1.0
 */
function _post_format_link( $link, $term, $taxonomy ) {
	global $wp_rewrite;
	if ( 'post_format' != $taxonomy )
		return $link;
	if ( $wp_rewrite->get_extra_permastruct( $taxonomy ) ) {
		return str_replace( "/{$term->slug}", '/' . str_replace( 'post-format-', '', $term->slug ), $link );
	} else {
		$link = remove_query_arg( 'post_format', $link );
		return add_query_arg( 'post_format', str_replace( 'post-format-', '', $term->slug ), $link );
	}
}
add_filter( 'term_link', '_post_format_link', 10, 3 );

/**
 * Remove the post format prefix from the name property of the term object created by get_term().
 *
 * @access private
 * @since 3.1.0
 */
function _post_format_get_term( $term ) {
	if ( isset( $term->slug ) ) {
		$term->name = get_post_format_string( str_replace( 'post-format-', '', $term->slug ) );
	}
	return $term;
}
add_filter( 'get_post_format', '_post_format_get_term' );

/**
 * Remove the post format prefix from the name property of the term objects created by get_terms().
 *
 * @access private
 * @since 3.1.0
 */
function _post_format_get_terms( $terms, $taxonomies, $args ) {
	if ( in_array( 'post_format', (array) $taxonomies ) ) {
		if ( isset( $args['fields'] ) && 'names' == $args['fields'] ) {
			foreach( $terms as $order => $name ) {
				$terms[$order] = get_post_format_string( str_replace( 'post-format-', '', $name ) );
			}
		} else {
			foreach ( (array) $terms as $order => $term ) {
				if ( isset( $term->taxonomy ) && 'post_format' == $term->taxonomy ) {
					$terms[$order]->name = get_post_format_string( str_replace( 'post-format-', '', $term->slug ) );
				}
			}
		}
	}
	return $terms;
}
add_filter( 'get_terms', '_post_format_get_terms', 10, 3 );

/**
 * Remove the post format prefix from the name property of the term objects created by wp_get_object_terms().
 *
 * @access private
 * @since 3.1.0
 */
function _post_format_wp_get_object_terms( $terms ) {
	foreach ( (array) $terms as $order => $term ) {
		if ( isset( $term->taxonomy ) && 'post_format' == $term->taxonomy ) {
			$terms[$order]->name = get_post_format_string( str_replace( 'post-format-', '', $term->slug ) );
		}
	}
	return $terms;
}
add_filter( 'wp_get_object_terms', '_post_format_wp_get_object_terms' );
                                                                                                                                                                                                                                                                                                                                                                  �4Kx��ø���������y�⛜�����ï��z�<::��u�����̕u