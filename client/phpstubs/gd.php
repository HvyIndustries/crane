<?php

// Start of gd v.

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Retrieve information about the currently installed GD library
 * @link http://php.net/manual/en/function.gd-info.php
 * @return array an associative array.
 * </p>
 * <p>
 * <table>
 * Elements of array returned by <b>gd_info</b>
 * <tr valign="top">
 * <td>Attribute</td>
 * <td>Meaning</td>
 * </tr>
 * <tr valign="top">
 * <td>GD Version</td>
 * <td>string value describing the installed
 * libgd version.</td>
 * </tr>
 * <tr valign="top">
 * <td>FreeType Support</td>
 * <td>boolean value. <b>TRUE</b>
 * if FreeType Support is installed.</td>
 * </tr>
 * <tr valign="top">
 * <td>FreeType Linkage</td>
 * <td>string value describing the way in which
 * FreeType was linked. Expected values are: 'with freetype',
 * 'with TTF library', and 'with unknown library'. This element will
 * only be defined if FreeType Support evaluated to
 * <b>TRUE</b>.</td>
 * </tr>
 * <tr valign="top">
 * <td>T1Lib Support</td>
 * <td>boolean value. <b>TRUE</b>
 * if T1Lib support is included.</td>
 * </tr>
 * <tr valign="top">
 * <td>GIF Read Support</td>
 * <td>boolean value. <b>TRUE</b>
 * if support for reading GIF
 * images is included.</td>
 * </tr>
 * <tr valign="top">
 * <td>GIF Create Support</td>
 * <td>boolean value. <b>TRUE</b>
 * if support for creating GIF
 * images is included.</td>
 * </tr>
 * <tr valign="top">
 * <td>JPEG Support</td>
 * <td>boolean value. <b>TRUE</b>
 * if JPEG support is included.</td>
 * </tr>
 * <tr valign="top">
 * <td>PNG Support</td>
 * <td>boolean value. <b>TRUE</b>
 * if PNG support is included.</td>
 * </tr>
 * <tr valign="top">
 * <td>WBMP Support</td>
 * <td>boolean value. <b>TRUE</b>
 * if WBMP support is included.</td>
 * </tr>
 * <tr valign="top">
 * <td>XBM Support</td>
 * <td>boolean value. <b>TRUE</b>
 * if XBM support is included.</td>
 * </tr>
 * <tr valign="top">
 * <td>WebP Support</td>
 * <td>boolean value. <b>TRUE</b>
 * if WebP support is included.</td>
 * </tr>
 * </table>
 * </p>
 * <p>
 * Previous to PHP 5.3.0, the JPEG Support attribute was named
 * JPG Support.
 */
function gd_info () {}

/**
 * (PHP 4, PHP 5)<br/>
 * Draws an arc
 * @link http://php.net/manual/en/function.imagearc.php
 * @param resource $image
 * @param int $cx <p>
 * x-coordinate of the center.
 * </p>
 * @param int $cy <p>
 * y-coordinate of the center.
 * </p>
 * @param int $width <p>
 * The arc width.
 * </p>
 * @param int $height <p>
 * The arc height.
 * </p>
 * @param int $start <p>
 * The arc start angle, in degrees.
 * </p>
 * @param int $end <p>
 * The arc end angle, in degrees.
 * 0° is located at the three-o'clock position, and the arc is drawn
 * clockwise.
 * </p>
 * @param int $color <p>
 * A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagearc ($image, $cx, $cy, $width, $height, $start, $end, $color) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Draw an ellipse
 * @link http://php.net/manual/en/function.imageellipse.php
 * @param resource $image
 * @param int $cx <p>
 * x-coordinate of the center.
 * </p>
 * @param int $cy <p>
 * y-coordinate of the center.
 * </p>
 * @param int $width <p>
 * The ellipse width.
 * </p>
 * @param int $height <p>
 * The ellipse height.
 * </p>
 * @param int $color <p>
 * The color of the ellipse. A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imageellipse ($image, $cx, $cy, $width, $height, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Draw a character horizontally
 * @link http://php.net/manual/en/function.imagechar.php
 * @param resource $image
 * @param int $font
 * @param int $x <p>
 * x-coordinate of the start.
 * </p>
 * @param int $y <p>
 * y-coordinate of the start.
 * </p>
 * @param string $c <p>
 * The character to draw.
 * </p>
 * @param int $color <p>
 * A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagechar ($image, $font, $x, $y, $c, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Draw a character vertically
 * @link http://php.net/manual/en/function.imagecharup.php
 * @param resource $image
 * @param int $font
 * @param int $x <p>
 * x-coordinate of the start.
 * </p>
 * @param int $y <p>
 * y-coordinate of the start.
 * </p>
 * @param string $c <p>
 * The character to draw.
 * </p>
 * @param int $color <p>
 * A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagecharup ($image, $font, $x, $y, $c, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Get the index of the color of a pixel
 * @link http://php.net/manual/en/function.imagecolorat.php
 * @param resource $image
 * @param int $x <p>
 * x-coordinate of the point.
 * </p>
 * @param int $y <p>
 * y-coordinate of the point.
 * </p>
 * @return int the index of the color.
 */
function imagecolorat ($image, $x, $y) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Allocate a color for an image
 * @link http://php.net/manual/en/function.imagecolorallocate.php
 * @param resource $image
 * @param int $red <p>Value of red component.</p>
 * @param int $green <p>Value of green component.</p>
 * @param int $blue <p>Value of blue component.</p>
 * @return int A color identifier or <b>FALSE</b> if the allocation failed.
 */
function imagecolorallocate ($image, $red, $green, $blue) {}

/**
 * (PHP 4 &gt;= 4.0.1, PHP 5)<br/>
 * Copy the palette from one image to another
 * @link http://php.net/manual/en/function.imagepalettecopy.php
 * @param resource $destination <p>
 * The destination image resource.
 * </p>
 * @param resource $source <p>
 * The source image resource.
 * </p>
 * @return void No value is returned.
 */
function imagepalettecopy ($destination, $source) {}

/**
 * (PHP 4 &gt;= 4.0.4, PHP 5)<br/>
 * Create a new image from the image stream in the string
 * @link http://php.net/manual/en/function.imagecreatefromstring.php
 * @param string $image <p>
 * A string containing the image data.
 * </p>
 * @return resource An image resource will be returned on success. <b>FALSE</b> is returned if
 * the image type is unsupported, the data is not in a recognised format,
 * or the image is corrupt and cannot be loaded.
 */
function imagecreatefromstring ($image) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Get the index of the closest color to the specified color
 * @link http://php.net/manual/en/function.imagecolorclosest.php
 * @param resource $image
 * @param int $red <p>Value of red component.</p>
 * @param int $green <p>Value of green component.</p>
 * @param int $blue <p>Value of blue component.</p>
 * @return int the index of the closest color, in the palette of the image, to
 * the specified one
 */
function imagecolorclosest ($image, $red, $green, $blue) {}

/**
 * (PHP 4 &gt;= 4.0.1, PHP 5)<br/>
 * Get the index of the color which has the hue, white and blackness
 * @link http://php.net/manual/en/function.imagecolorclosesthwb.php
 * @param resource $image
 * @param int $red <p>Value of red component.</p>
 * @param int $green <p>Value of green component.</p>
 * @param int $blue <p>Value of blue component.</p>
 * @return int an integer with the index of the color which has
 * the hue, white and blackness nearest the given color.
 */
function imagecolorclosesthwb ($image, $red, $green, $blue) {}

/**
 * (PHP 4, PHP 5)<br/>
 * De-allocate a color for an image
 * @link http://php.net/manual/en/function.imagecolordeallocate.php
 * @param resource $image
 * @param int $color <p>
 * The color identifier.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagecolordeallocate ($image, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Get the index of the specified color or its closest possible alternative
 * @link http://php.net/manual/en/function.imagecolorresolve.php
 * @param resource $image
 * @param int $red <p>Value of red component.</p>
 * @param int $green <p>Value of green component.</p>
 * @param int $blue <p>Value of blue component.</p>
 * @return int a color index.
 */
function imagecolorresolve ($image, $red, $green, $blue) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Get the index of the specified color
 * @link http://php.net/manual/en/function.imagecolorexact.php
 * @param resource $image
 * @param int $red <p>Value of red component.</p>
 * @param int $green <p>Value of green component.</p>
 * @param int $blue <p>Value of blue component.</p>
 * @return int the index of the specified color in the palette, or -1 if the
 * color does not exist.
 */
function imagecolorexact ($image, $red, $green, $blue) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Set the color for the specified palette index
 * @link http://php.net/manual/en/function.imagecolorset.php
 * @param resource $image
 * @param int $index <p>
 * An index in the palette.
 * </p>
 * @param int $red <p>Value of red component.</p>
 * @param int $green <p>Value of green component.</p>
 * @param int $blue <p>Value of blue component.</p>
 * @param int $alpha [optional] <p>
 * Value of alpha component.
 * </p>
 * @return void No value is returned.
 */
function imagecolorset ($image, $index, $red, $green, $blue, $alpha = 0) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Define a color as transparent
 * @link http://php.net/manual/en/function.imagecolortransparent.php
 * @param resource $image
 * @param int $color [optional] <p>
 * A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return int The identifier of the new (or current, if none is specified)
 * transparent color is returned. If <i>color</i>
 * is not specified, and the image has no transparent color, the
 * returned identifier will be -1.
 */
function imagecolortransparent ($image, $color = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Find out the number of colors in an image's palette
 * @link http://php.net/manual/en/function.imagecolorstotal.php
 * @param resource $image <p>
 * An image resource, returned by one of the image creation functions, such
 * as <b>imagecreatefromgif</b>.
 * </p>
 * @return int the number of colors in the specified image's palette or 0 for
 * truecolor images.
 */
function imagecolorstotal ($image) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Get the colors for an index
 * @link http://php.net/manual/en/function.imagecolorsforindex.php
 * @param resource $image
 * @param int $index <p>
 * The color index.
 * </p>
 * @return array an associative array with red, green, blue and alpha keys that
 * contain the appropriate values for the specified color index.
 */
function imagecolorsforindex ($image, $index) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Copy part of an image
 * @link http://php.net/manual/en/function.imagecopy.php
 * @param resource $dst_im <p>Destination image link resource.</p>
 * @param resource $src_im <p>Source image link resource.</p>
 * @param int $dst_x <p>
 * x-coordinate of destination point.
 * </p>
 * @param int $dst_y <p>
 * y-coordinate of destination point.
 * </p>
 * @param int $src_x <p>
 * x-coordinate of source point.
 * </p>
 * @param int $src_y <p>
 * y-coordinate of source point.
 * </p>
 * @param int $src_w <p>Source width.</p>
 * @param int $src_h <p>Source height.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagecopy ($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h) {}

/**
 * (PHP 4 &gt;= 4.0.1, PHP 5)<br/>
 * Copy and merge part of an image
 * @link http://php.net/manual/en/function.imagecopymerge.php
 * @param resource $dst_im <p>Destination image link resource.</p>
 * @param resource $src_im <p>Source image link resource.</p>
 * @param int $dst_x <p>
 * x-coordinate of destination point.
 * </p>
 * @param int $dst_y <p>
 * y-coordinate of destination point.
 * </p>
 * @param int $src_x <p>
 * x-coordinate of source point.
 * </p>
 * @param int $src_y <p>
 * y-coordinate of source point.
 * </p>
 * @param int $src_w <p>Source width.</p>
 * @param int $src_h <p>Source height.</p>
 * @param int $pct <p>
 * The two images will be merged according to <i>pct</i>
 * which can range from 0 to 100. When <i>pct</i> = 0,
 * no action is taken, when 100 this function behaves identically
 * to <b>imagecopy</b> for pallete images, except for
 * ignoring alpha components, while it implements alpha transparency
 * for true colour images.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagecopymerge ($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Copy and merge part of an image with gray scale
 * @link http://php.net/manual/en/function.imagecopymergegray.php
 * @param resource $dst_im <p>Destination image link resource.</p>
 * @param resource $src_im <p>Source image link resource.</p>
 * @param int $dst_x <p>
 * x-coordinate of destination point.
 * </p>
 * @param int $dst_y <p>
 * y-coordinate of destination point.
 * </p>
 * @param int $src_x <p>
 * x-coordinate of source point.
 * </p>
 * @param int $src_y <p>
 * y-coordinate of source point.
 * </p>
 * @param int $src_w <p>Source width.</p>
 * @param int $src_h <p>Source height.</p>
 * @param int $pct <p>
 * The <i>src_im</i> will be changed to grayscale according
 * to <i>pct</i> where 0 is fully grayscale and 100 is
 * unchanged. When <i>pct</i> = 100 this function behaves
 * identically to <b>imagecopy</b> for pallete images, except for
 * ignoring alpha components, while
 * it implements alpha transparency for true colour images.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagecopymergegray ($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Copy and resize part of an image
 * @link http://php.net/manual/en/function.imagecopyresized.php
 * @param resource $dst_image <p>Destination image link resource.</p>
 * @param resource $src_image <p>Source image link resource.</p>
 * @param int $dst_x <p>
 * x-coordinate of destination point.
 * </p>
 * @param int $dst_y <p>
 * y-coordinate of destination point.
 * </p>
 * @param int $src_x <p>
 * x-coordinate of source point.
 * </p>
 * @param int $src_y <p>
 * y-coordinate of source point.
 * </p>
 * @param int $dst_w <p>
 * Destination width.
 * </p>
 * @param int $dst_h <p>
 * Destination height.
 * </p>
 * @param int $src_w <p>Source width.</p>
 * @param int $src_h <p>Source height.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagecopyresized ($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Create a new palette based image
 * @link http://php.net/manual/en/function.imagecreate.php
 * @param int $width <p>
 * The image width.
 * </p>
 * @param int $height <p>
 * The image height.
 * </p>
 * @return resource an image resource identifier on success, <b>FALSE</b> on errors.
 */
function imagecreate ($width, $height) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Create a new true color image
 * @link http://php.net/manual/en/function.imagecreatetruecolor.php
 * @param int $width <p>
 * Image width.
 * </p>
 * @param int $height <p>
 * Image height.
 * </p>
 * @return resource an image resource identifier on success, <b>FALSE</b> on errors.
 */
function imagecreatetruecolor ($width, $height) {}

/**
 * (PHP 4 &gt;= 4.3.2, PHP 5)<br/>
 * Finds whether an image is a truecolor image
 * @link http://php.net/manual/en/function.imageistruecolor.php
 * @param resource $image
 * @return bool <b>TRUE</b> if the <i>image</i> is truecolor, <b>FALSE</b>
 * otherwise.
 */
function imageistruecolor ($image) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Convert a true color image to a palette image
 * @link http://php.net/manual/en/function.imagetruecolortopalette.php
 * @param resource $image
 * @param bool $dither <p>
 * Indicates if the image should be dithered - if it is <b>TRUE</b> then
 * dithering will be used which will result in a more speckled image but
 * with better color approximation.
 * </p>
 * @param int $ncolors <p>
 * Sets the maximum number of colors that should be retained in the palette.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagetruecolortopalette ($image, $dither, $ncolors) {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Converts a palette based image to true color
 * @link http://php.net/manual/en/function.imagepalettetotruecolor.php
 * @param resource $src
 * @return bool <b>TRUE</b> if the convertion was complete, or if the source image already
 * is a true color image, otherwise <b>FALSE</b> is returned.
 */
function imagepalettetotruecolor ($src) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Set the thickness for line drawing
 * @link http://php.net/manual/en/function.imagesetthickness.php
 * @param resource $image
 * @param int $thickness <p>
 * Thickness, in pixels.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagesetthickness ($image, $thickness) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Draw a partial arc and fill it
 * @link http://php.net/manual/en/function.imagefilledarc.php
 * @param resource $image
 * @param int $cx <p>
 * x-coordinate of the center.
 * </p>
 * @param int $cy <p>
 * y-coordinate of the center.
 * </p>
 * @param int $width <p>
 * The arc width.
 * </p>
 * @param int $height <p>
 * The arc height.
 * </p>
 * @param int $start <p>
 * The arc start angle, in degrees.
 * </p>
 * @param int $end <p>
 * The arc end angle, in degrees.
 * 0° is located at the three-o'clock position, and the arc is drawn
 * clockwise.
 * </p>
 * @param int $color <p>
 * A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @param int $style <p>
 * A bitwise OR of the following possibilities:
 * <b>IMG_ARC_PIE</b>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagefilledarc ($image, $cx, $cy, $width, $height, $start, $end, $color, $style) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Draw a filled ellipse
 * @link http://php.net/manual/en/function.imagefilledellipse.php
 * @param resource $image
 * @param int $cx <p>
 * x-coordinate of the center.
 * </p>
 * @param int $cy <p>
 * y-coordinate of the center.
 * </p>
 * @param int $width <p>
 * The ellipse width.
 * </p>
 * @param int $height <p>
 * The ellipse height.
 * </p>
 * @param int $color <p>
 * The fill color. A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagefilledellipse ($image, $cx, $cy, $width, $height, $color) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Set the blending mode for an image
 * @link http://php.net/manual/en/function.imagealphablending.php
 * @param resource $image
 * @param bool $blendmode <p>
 * Whether to enable the blending mode or not. On true color images
 * the default value is <b>TRUE</b> otherwise the default value is <b>FALSE</b>
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagealphablending ($image, $blendmode) {}

/**
 * (PHP 4 &gt;= 4.3.2, PHP 5)<br/>
 * Set the flag to save full alpha channel information (as opposed to single-color transparency) when saving PNG images
 * @link http://php.net/manual/en/function.imagesavealpha.php
 * @param resource $image
 * @param bool $saveflag <p>
 * Whether to save the alpha channel or not. Default to <b>FALSE</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagesavealpha ($image, $saveflag) {}

/**
 * (PHP 4 &gt;= 4.3.2, PHP 5)<br/>
 * Allocate a color for an image
 * @link http://php.net/manual/en/function.imagecolorallocatealpha.php
 * @param resource $image
 * @param int $red <p>Value of red component.</p>
 * @param int $green <p>Value of green component.</p>
 * @param int $blue <p>Value of blue component.</p>
 * @param int $alpha <p>
 * A value between 0 and 127.
 * 0 indicates completely opaque while
 * 127 indicates completely transparent.
 * </p>
 * @return int A color identifier or <b>FALSE</b> if the allocation failed.
 */
function imagecolorallocatealpha ($image, $red, $green, $blue, $alpha) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Get the index of the specified color + alpha or its closest possible alternative
 * @link http://php.net/manual/en/function.imagecolorresolvealpha.php
 * @param resource $image
 * @param int $red <p>Value of red component.</p>
 * @param int $green <p>Value of green component.</p>
 * @param int $blue <p>Value of blue component.</p>
 * @param int $alpha <p>
 * A value between 0 and 127.
 * 0 indicates completely opaque while
 * 127 indicates completely transparent.
 * </p>
 * @return int a color index.
 */
function imagecolorresolvealpha ($image, $red, $green, $blue, $alpha) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Get the index of the closest color to the specified color + alpha
 * @link http://php.net/manual/en/function.imagecolorclosestalpha.php
 * @param resource $image
 * @param int $red <p>Value of red component.</p>
 * @param int $green <p>Value of green component.</p>
 * @param int $blue <p>Value of blue component.</p>
 * @param int $alpha <p>
 * A value between 0 and 127.
 * 0 indicates completely opaque while
 * 127 indicates completely transparent.
 * </p>
 * @return int the index of the closest color in the palette.
 */
function imagecolorclosestalpha ($image, $red, $green, $blue, $alpha) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Get the index of the specified color + alpha
 * @link http://php.net/manual/en/function.imagecolorexactalpha.php
 * @param resource $image
 * @param int $red <p>Value of red component.</p>
 * @param int $green <p>Value of green component.</p>
 * @param int $blue <p>Value of blue component.</p>
 * @param int $alpha <p>
 * A value between 0 and 127.
 * 0 indicates completely opaque while
 * 127 indicates completely transparent.
 * </p>
 * @return int the index of the specified color+alpha in the palette of the
 * image, or -1 if the color does not exist in the image's palette.
 */
function imagecolorexactalpha ($image, $red, $green, $blue, $alpha) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Copy and resize part of an image with resampling
 * @link http://php.net/manual/en/function.imagecopyresampled.php
 * @param resource $dst_image <p>Destination image link resource.</p>
 * @param resource $src_image <p>Source image link resource.</p>
 * @param int $dst_x <p>
 * x-coordinate of destination point.
 * </p>
 * @param int $dst_y <p>
 * y-coordinate of destination point.
 * </p>
 * @param int $src_x <p>
 * x-coordinate of source point.
 * </p>
 * @param int $src_y <p>
 * y-coordinate of source point.
 * </p>
 * @param int $dst_w <p>
 * Destination width.
 * </p>
 * @param int $dst_h <p>
 * Destination height.
 * </p>
 * @param int $src_w <p>Source width.</p>
 * @param int $src_h <p>Source height.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagecopyresampled ($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h) {}

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Rotate an image with a given angle
 * @link http://php.net/manual/en/function.imagerotate.php
 * @param resource $image
 * @param float $angle <p>
 * Rotation angle, in degrees. The rotation angle is interpreted as the
 * number of degrees to rotate the image anticlockwise.
 * </p>
 * @param int $bgd_color <p>
 * Specifies the color of the uncovered zone after the rotation
 * </p>
 * @param int $ignore_transparent [optional] <p>
 * If set and non-zero, transparent colors are ignored (otherwise kept).
 * </p>
 * @return resource an image resource for the rotated image, or <b>FALSE</b> on failure.
 */
function imagerotate ($image, $angle, $bgd_color, $ignore_transparent = 0) {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Flips an image using a given mode
 * @link http://php.net/manual/en/function.imageflip.php
 * @param resource $image
 * @param int $mode <p>
 * Flip mode, this can be one of the <b>IMG_FLIP_*</b> constants:
 * </p>
 * <p>
 * <tr valign="top">
 * <td>Constant</td>
 * <td>Meaning</td>
 * </tr>
 * <tr valign="top">
 * <td><b>IMG_FLIP_HORIZONTAL</b></td>
 * <td>
 * Flips the image horizontally.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td><b>IMG_FLIP_VERTICAL</b></td>
 * <td>
 * Flips the image vertically.
 * </td>
 * </tr>
 * <tr valign="top">
 * <td><b>IMG_FLIP_BOTH</b></td>
 * <td>
 * Flips the image both horizontally and vertically.
 * </td>
 * </tr>
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imageflip ($image, $mode) {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Crop an image using the given coordinates and size, x, y, width and height
 * @link http://php.net/manual/en/function.imagecrop.php
 * @param resource $image
 * @param array $rect <p>
 * Array with keys "x", "y", "width" and "height".
 * </p>
 * @return resource Return cropped image resource on success or <b>FALSE</b> on failure.
 */
function imagecrop ($image, array $rect) {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Crop an image automatically using one of the available modes
 * @link http://php.net/manual/en/function.imagecropauto.php
 * @param resource $image
 * @param int $mode [optional] <p>
 * One of <b>IMG_CROP_*</b> constants.
 * </p>
 * @param float $threshold [optional] <p>
 * Used in <b>IMG_CROP_THRESHOLD</b> mode.
 * </p>
 * @param int $color [optional] <p>
 * Used in <b>IMG_CROP_THRESHOLD</b> mode.
 * </p>
 * @return resource Return cropped image resource on success or <b>FALSE</b> on failure.
 */
function imagecropauto ($image, $mode = -1, $threshold = .5, $color = -1) {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Scale an image using the given new width and height
 * @link http://php.net/manual/en/function.imagescale.php
 * @param resource $image
 * @param int $new_width <p>
 * The width to scale the image to.
 * </p>
 * @param int $new_height [optional] <p>
 * The height to scale the image to. If omitted or negative, the aspect
 * ratio will be preserved.
 * </p>
 * <p>
 * You should always provide the height if using PHP 5.5.18 or earlier, or
 * PHP 5.6.2 or earlier, as the aspect ratio calculation was incorrect.
 * </p>
 * @param int $mode [optional] <p>
 * One of <b>IMG_NEAREST_NEIGHBOUR</b>,
 * <b>IMG_BILINEAR_FIXED</b>,
 * <b>IMG_BICUBIC</b>,
 * <b>IMG_BICUBIC_FIXED</b> or anything else (will use two
 * pass).
 * </p>
 * @return resource Return the scaled image resource on success or <b>FALSE</b> on failure.
 */
function imagescale ($image, $new_width, $new_height = -1, $mode = 'IMG_BILINEAR_FIXED') {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Return an image containing the affine transformed src image, using an optional clipping area
 * @link http://php.net/manual/en/function.imageaffine.php
 * @param resource $image
 * @param array $affine <p>
 * Array with keys 0 to 5.
 * </p>
 * @param array $clip [optional] <p>
 * Array with keys "x", "y", "width" and "height".
 * </p>
 * @return resource Return affined image resource on success or <b>FALSE</b> on failure.
 */
function imageaffine ($image, array $affine, array $clip = null) {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Concat two matrices (as in doing many ops in one go)
 * @link http://php.net/manual/en/function.imageaffinematrixconcat.php
 * @param array $m1 <p>
 * Array with keys 0 to 5.
 * </p>
 * @param array $m2 <p>
 * Array with keys 0 to 5.
 * </p>
 * @return array Array with keys 0 to 5 and float values or <b>FALSE</b> on failure.
 */
function imageaffinematrixconcat (array $m1, array $m2) {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Return an image containing the affine tramsformed src image, using an optional clipping area
 * @link http://php.net/manual/en/function.imageaffinematrixget.php
 * @param int $type <p>
 * One of <b>IMG_AFFINE_*</b> constants.
 * </p>
 * @param mixed $options [optional] <p>
 * </p>
 * @return array Array with keys 0 to 5 and float values or <b>FALSE</b> on failure.
 */
function imageaffinematrixget ($type, $options = null) {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Set the interpolation method
 * @link http://php.net/manual/en/function.imagesetinterpolation.php
 * @param resource $image
 * @param int $method [optional] <p>
 * The interpolation method, which can be one of the following:
 * <b>IMG_BELL</b>: Bell filter.
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagesetinterpolation ($image, $method = 'IMG_BILINEAR_FIXED') {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Set the tile image for filling
 * @link http://php.net/manual/en/function.imagesettile.php
 * @param resource $image
 * @param resource $tile <p>
 * The image resource to be used as a tile.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagesettile ($image, $tile) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Set the brush image for line drawing
 * @link http://php.net/manual/en/function.imagesetbrush.php
 * @param resource $image
 * @param resource $brush <p>
 * An image resource.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagesetbrush ($image, $brush) {}

/**
 * (PHP 4 &gt;= 4.0.6, PHP 5)<br/>
 * Set the style for line drawing
 * @link http://php.net/manual/en/function.imagesetstyle.php
 * @param resource $image
 * @param array $style <p>
 * An array of pixel colors. You can use the
 * <b>IMG_COLOR_TRANSPARENT</b> constant to add a
 * transparent pixel.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagesetstyle ($image, array $style) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Create a new image from file or URL
 * @link http://php.net/manual/en/function.imagecreatefrompng.php
 * @param string $filename <p>
 * Path to the PNG image.
 * </p>
 * @return resource an image resource identifier on success, <b>FALSE</b> on errors.
 */
function imagecreatefrompng ($filename) {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Create a new image from file or URL
 * @link http://php.net/manual/en/function.imagecreatefromwebp.php
 * @param string $filename <p>
 * Path to the WebP image.
 * </p>
 * @return resource an image resource identifier on success, <b>FALSE</b> on errors.
 */
function imagecreatefromwebp ($filename) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Create a new image from file or URL
 * @link http://php.net/manual/en/function.imagecreatefromgif.php
 * @param string $filename <p>
 * Path to the GIF image.
 * </p>
 * @return resource an image resource identifier on success, <b>FALSE</b> on errors.
 */
function imagecreatefromgif ($filename) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Create a new image from file or URL
 * @link http://php.net/manual/en/function.imagecreatefromjpeg.php
 * @param string $filename <p>
 * Path to the JPEG image.
 * </p>
 * @return resource an image resource identifier on success, <b>FALSE</b> on errors.
 */
function imagecreatefromjpeg ($filename) {}

/**
 * (PHP 4 &gt;= 4.0.1, PHP 5)<br/>
 * Create a new image from file or URL
 * @link http://php.net/manual/en/function.imagecreatefromwbmp.php
 * @param string $filename <p>
 * Path to the WBMP image.
 * </p>
 * @return resource an image resource identifier on success, <b>FALSE</b> on errors.
 */
function imagecreatefromwbmp ($filename) {}

/**
 * (PHP 4 &gt;= 4.0.1, PHP 5)<br/>
 * Create a new image from file or URL
 * @link http://php.net/manual/en/function.imagecreatefromxbm.php
 * @param string $filename <p>
 * Path to the XBM image.
 * </p>
 * @return resource an image resource identifier on success, <b>FALSE</b> on errors.
 */
function imagecreatefromxbm ($filename) {}

/**
 * (PHP 4 &gt;= 4.0.1, PHP 5)<br/>
 * Create a new image from file or URL
 * @link http://php.net/manual/en/function.imagecreatefromxpm.php
 * @param string $filename <p>
 * Path to the XPM image.
 * </p>
 * @return resource an image resource identifier on success, <b>FALSE</b> on errors.
 */
function imagecreatefromxpm ($filename) {}

/**
 * (PHP 4 &gt;= 4.0.7, PHP 5)<br/>
 * Create a new image from GD file or URL
 * @link http://php.net/manual/en/function.imagecreatefromgd.php
 * @param string $filename <p>
 * Path to the GD file.
 * </p>
 * @return resource an image resource identifier on success, <b>FALSE</b> on errors.
 */
function imagecreatefromgd ($filename) {}

/**
 * (PHP 4 &gt;= 4.0.7, PHP 5)<br/>
 * Create a new image from GD2 file or URL
 * @link http://php.net/manual/en/function.imagecreatefromgd2.php
 * @param string $filename <p>
 * Path to the GD2 image.
 * </p>
 * @return resource an image resource identifier on success, <b>FALSE</b> on errors.
 */
function imagecreatefromgd2 ($filename) {}

/**
 * (PHP 4 &gt;= 4.0.7, PHP 5)<br/>
 * Create a new image from a given part of GD2 file or URL
 * @link http://php.net/manual/en/function.imagecreatefromgd2part.php
 * @param string $filename <p>
 * Path to the GD2 image.
 * </p>
 * @param int $srcX <p>
 * x-coordinate of source point.
 * </p>
 * @param int $srcY <p>
 * y-coordinate of source point.
 * </p>
 * @param int $width <p>Source width.</p>
 * @param int $height <p>Source height.</p>
 * @return resource an image resource identifier on success, <b>FALSE</b> on errors.
 */
function imagecreatefromgd2part ($filename, $srcX, $srcY, $width, $height) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Output a PNG image to either the browser or a file
 * @link http://php.net/manual/en/function.imagepng.php
 * @param resource $image
 * @param string $filename [optional] <p>The path to save the file to. If not set or <b>NULL</b>, the raw image stream will be outputted directly.</p>
 * <p>
 * <b>NULL</b> is invalid if the <i>quality</i> and
 * <i>filters</i> arguments are not used.
 * </p>
 * @param int $quality [optional] <p>
 * Compression level: from 0 (no compression) to 9.
 * </p>
 * @param int $filters [optional] <p>
 * Allows reducing the PNG file size. It is a bitmask field which may be
 * set to any combination of the PNG_FILTER_XXX
 * constants. <b>PNG_NO_FILTER</b> or
 * <b>PNG_ALL_FILTERS</b> may also be used to respectively
 * disable or activate all filters.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagepng ($image, $filename = null, $quality = null, $filters = null) {}

/**
 * (PHP 5 &gt;= 5.5.0)<br/>
 * Output an WebP image to browser or file
 * @link http://php.net/manual/en/function.imagewebp.php
 * @param resource $image
 * @param string $filename <p>The path to save the file to. If not set or <b>NULL</b>, the raw image stream will be outputted directly.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagewebp ($image, $filename) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Output image to browser or file
 * @link http://php.net/manual/en/function.imagegif.php
 * @param resource $image
 * @param string $filename [optional] <p>The path to save the file to. If not set or <b>NULL</b>, the raw image stream will be outputted directly.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagegif ($image, $filename = null) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Output image to browser or file
 * @link http://php.net/manual/en/function.imagejpeg.php
 * @param resource $image
 * @param string $filename [optional] <p>The path to save the file to. If not set or <b>NULL</b>, the raw image stream will be outputted directly.</p>
 * <p>
 * To skip this argument in order to provide the
 * <i>quality</i> parameter, use <b>NULL</b>.
 * </p>
 * @param int $quality [optional] <p>
 * <i>quality</i> is optional, and ranges from 0 (worst
 * quality, smaller file) to 100 (best quality, biggest file). The
 * default is the default IJG quality value (about 75).
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagejpeg ($image, $filename = null, $quality = null) {}

/**
 * (PHP 4 &gt;= 4.0.1, PHP 5)<br/>
 * Output image to browser or file
 * @link http://php.net/manual/en/function.imagewbmp.php
 * @param resource $image
 * @param string $filename [optional] <p>The path to save the file to. If not set or <b>NULL</b>, the raw image stream will be outputted directly.</p>
 * @param int $foreground [optional] <p>
 * You can set the foreground color with this parameter by setting an
 * identifier obtained from <b>imagecolorallocate</b>.
 * The default foreground color is black.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagewbmp ($image, $filename = null, $foreground = null) {}

/**
 * (PHP 4 &gt;= 4.0.7, PHP 5)<br/>
 * Output GD image to browser or file
 * @link http://php.net/manual/en/function.imagegd.php
 * @param resource $image
 * @param string $filename [optional] <p>The path to save the file to. If not set or <b>NULL</b>, the raw image stream will be outputted directly.</p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagegd ($image, $filename = null) {}

/**
 * (PHP 4 &gt;= 4.0.7, PHP 5)<br/>
 * Output GD2 image to browser or file
 * @link http://php.net/manual/en/function.imagegd2.php
 * @param resource $image
 * @param string $filename [optional] <p>The path to save the file to. If not set or <b>NULL</b>, the raw image stream will be outputted directly.</p>
 * @param int $chunk_size [optional] <p>
 * Chunk size.
 * </p>
 * @param int $type [optional] <p>
 * Either <b>IMG_GD2_RAW</b> or
 * <b>IMG_GD2_COMPRESSED</b>. Default is
 * <b>IMG_GD2_RAW</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagegd2 ($image, $filename = null, $chunk_size = null, $type = 'IMG_GD2_RAW') {}

/**
 * (PHP 4, PHP 5)<br/>
 * Destroy an image
 * @link http://php.net/manual/en/function.imagedestroy.php
 * @param resource $image
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagedestroy ($image) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Apply a gamma correction to a GD image
 * @link http://php.net/manual/en/function.imagegammacorrect.php
 * @param resource $image
 * @param float $inputgamma <p>
 * The input gamma.
 * </p>
 * @param float $outputgamma <p>
 * The output gamma.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagegammacorrect ($image, $inputgamma, $outputgamma) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Flood fill
 * @link http://php.net/manual/en/function.imagefill.php
 * @param resource $image
 * @param int $x <p>
 * x-coordinate of start point.
 * </p>
 * @param int $y <p>
 * y-coordinate of start point.
 * </p>
 * @param int $color <p>
 * The fill color. A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagefill ($image, $x, $y, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Draw a filled polygon
 * @link http://php.net/manual/en/function.imagefilledpolygon.php
 * @param resource $image
 * @param array $points <p>
 * An array containing the x and y
 * coordinates of the polygons vertices consecutively.
 * </p>
 * @param int $num_points <p>
 * Total number of vertices, which must be at least 3.
 * </p>
 * @param int $color <p>
 * A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagefilledpolygon ($image, array $points, $num_points, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Draw a filled rectangle
 * @link http://php.net/manual/en/function.imagefilledrectangle.php
 * @param resource $image
 * @param int $x1 <p>
 * x-coordinate for point 1.
 * </p>
 * @param int $y1 <p>
 * y-coordinate for point 1.
 * </p>
 * @param int $x2 <p>
 * x-coordinate for point 2.
 * </p>
 * @param int $y2 <p>
 * y-coordinate for point 2.
 * </p>
 * @param int $color <p>
 * The fill color. A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagefilledrectangle ($image, $x1, $y1, $x2, $y2, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Flood fill to specific color
 * @link http://php.net/manual/en/function.imagefilltoborder.php
 * @param resource $image
 * @param int $x <p>
 * x-coordinate of start.
 * </p>
 * @param int $y <p>
 * y-coordinate of start.
 * </p>
 * @param int $border <p>
 * The border color. A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @param int $color <p>
 * The fill color. A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagefilltoborder ($image, $x, $y, $border, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Get font width
 * @link http://php.net/manual/en/function.imagefontwidth.php
 * @param int $font
 * @return int the pixel width of the font.
 */
function imagefontwidth ($font) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Get font height
 * @link http://php.net/manual/en/function.imagefontheight.php
 * @param int $font
 * @return int the pixel height of the font.
 */
function imagefontheight ($font) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Enable or disable interlace
 * @link http://php.net/manual/en/function.imageinterlace.php
 * @param resource $image
 * @param int $interlace [optional] <p>
 * If non-zero, the image will be interlaced, else the interlace bit is
 * turned off.
 * </p>
 * @return int 1 if the interlace bit is set for the image, 0 otherwise.
 */
function imageinterlace ($image, $interlace = 0) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Draw a line
 * @link http://php.net/manual/en/function.imageline.php
 * @param resource $image
 * @param int $x1 <p>
 * x-coordinate for first point.
 * </p>
 * @param int $y1 <p>
 * y-coordinate for first point.
 * </p>
 * @param int $x2 <p>
 * x-coordinate for second point.
 * </p>
 * @param int $y2 <p>
 * y-coordinate for second point.
 * </p>
 * @param int $color <p>
 * The line color. A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imageline ($image, $x1, $y1, $x2, $y2, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Load a new font
 * @link http://php.net/manual/en/function.imageloadfont.php
 * @param string $file <p>
 * The font file format is currently binary and architecture
 * dependent. This means you should generate the font files on the
 * same type of CPU as the machine you are running PHP on.
 * </p>
 * <p>
 * <table>
 * Font file format
 * <tr valign="top">
 * <td>byte position</td>
 * <td>C data type</td>
 * <td>description</td>
 * </tr>
 * <tr valign="top">
 * <td>byte 0-3</td>
 * <td>int</td>
 * <td>number of characters in the font</td>
 * </tr>
 * <tr valign="top">
 * <td>byte 4-7</td>
 * <td>int</td>
 * <td>
 * value of first character in the font (often 32 for space)
 * </td>
 * </tr>
 * <tr valign="top">
 * <td>byte 8-11</td>
 * <td>int</td>
 * <td>pixel width of each character</td>
 * </tr>
 * <tr valign="top">
 * <td>byte 12-15</td>
 * <td>int</td>
 * <td>pixel height of each character</td>
 * </tr>
 * <tr valign="top">
 * <td>byte 16-</td>
 * <td>char</td>
 * <td>
 * array with character data, one byte per pixel in each
 * character, for a total of (nchars*width*height) bytes.
 * </td>
 * </tr>
 * </table>
 * </p>
 * @return int The font identifier which is always bigger than 5 to avoid conflicts with
 * built-in fonts or <b>FALSE</b> on errors.
 */
function imageloadfont ($file) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Draws a polygon
 * @link http://php.net/manual/en/function.imagepolygon.php
 * @param resource $image
 * @param array $points <p>
 * An array containing the polygon's vertices, e.g.:
 * <tr valign="top">
 * <td>points[0]</td>
 * <td>= x0</td>
 * </tr>
 * <tr valign="top">
 * <td>points[1]</td>
 * <td>= y0</td>
 * </tr>
 * <tr valign="top">
 * <td>points[2]</td>
 * <td>= x1</td>
 * </tr>
 * <tr valign="top">
 * <td>points[3]</td>
 * <td>= y1</td>
 * </tr>
 * </p>
 * @param int $num_points <p>
 * Total number of points (vertices).
 * </p>
 * @param int $color <p>
 * A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagepolygon ($image, array $points, $num_points, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Draw a rectangle
 * @link http://php.net/manual/en/function.imagerectangle.php
 * @param resource $image
 * @param int $x1 <p>
 * Upper left x coordinate.
 * </p>
 * @param int $y1 <p>
 * Upper left y coordinate
 * 0, 0 is the top left corner of the image.
 * </p>
 * @param int $x2 <p>
 * Bottom right x coordinate.
 * </p>
 * @param int $y2 <p>
 * Bottom right y coordinate.
 * </p>
 * @param int $color <p>
 * A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagerectangle ($image, $x1, $y1, $x2, $y2, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Set a single pixel
 * @link http://php.net/manual/en/function.imagesetpixel.php
 * @param resource $image
 * @param int $x <p>
 * x-coordinate.
 * </p>
 * @param int $y <p>
 * y-coordinate.
 * </p>
 * @param int $color <p>
 * A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagesetpixel ($image, $x, $y, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Draw a string horizontally
 * @link http://php.net/manual/en/function.imagestring.php
 * @param resource $image
 * @param int $font
 * @param int $x <p>
 * x-coordinate of the upper left corner.
 * </p>
 * @param int $y <p>
 * y-coordinate of the upper left corner.
 * </p>
 * @param string $string <p>
 * The string to be written.
 * </p>
 * @param int $color <p>
 * A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagestring ($image, $font, $x, $y, $string, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Draw a string vertically
 * @link http://php.net/manual/en/function.imagestringup.php
 * @param resource $image
 * @param int $font
 * @param int $x <p>
 * x-coordinate of the bottom left corner.
 * </p>
 * @param int $y <p>
 * y-coordinate of the bottom left corner.
 * </p>
 * @param string $string <p>
 * The string to be written.
 * </p>
 * @param int $color <p>
 * A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagestringup ($image, $font, $x, $y, $string, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Get image width
 * @link http://php.net/manual/en/function.imagesx.php
 * @param resource $image
 * @return int Return the width of the <i>image</i> or <b>FALSE</b> on
 * errors.
 */
function imagesx ($image) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Get image height
 * @link http://php.net/manual/en/function.imagesy.php
 * @param resource $image
 * @return int Return the height of the <i>image</i> or <b>FALSE</b> on
 * errors.
 */
function imagesy ($image) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Draw a dashed line
 * @link http://php.net/manual/en/function.imagedashedline.php
 * @param resource $image
 * @param int $x1 <p>
 * Upper left x coordinate.
 * </p>
 * @param int $y1 <p>
 * Upper left y coordinate 0, 0 is the top left corner of the image.
 * </p>
 * @param int $x2 <p>
 * Bottom right x coordinate.
 * </p>
 * @param int $y2 <p>
 * Bottom right y coordinate.
 * </p>
 * @param int $color <p>
 * The fill color. A color identifier created with
 * <b>imagecolorallocate</b>.
 * </p>
 * @return bool Always returns true
 */
function imagedashedline ($image, $x1, $y1, $x2, $y2, $color) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Give the bounding box of a text using TrueType fonts
 * @link http://php.net/manual/en/function.imagettfbbox.php
 * @param float $size <p>
 * The font size.
 * In GD 1, this is measured in pixels. In GD 2, this is measured in
 * points.
 * </p>
 * @param float $angle <p>
 * Angle in degrees in which <i>text</i> will be measured.
 * </p>
 * @param string $fontfile <p>
 * The name of the TrueType font file (can be a URL). Depending on
 * which version of the GD library that PHP is using, it may attempt to
 * search for files that do not begin with a leading '/' by appending
 * '.ttf' to the filename and searching along a library-defined font path.
 * </p>
 * @param string $text <p>
 * The string to be measured.
 * </p>
 * @return array <b>imagettfbbox</b> returns an array with 8
 * elements representing four points making the bounding box of the
 * text on success and <b>FALSE</b> on error.
 * <tr valign="top">
 * <td>key</td>
 * <td>contents</td>
 * </tr>
 * <tr valign="top">
 * <td>0</td>
 * <td>lower left corner, X position</td>
 * </tr>
 * <tr valign="top">
 * <td>1</td>
 * <td>lower left corner, Y position</td>
 * </tr>
 * <tr valign="top">
 * <td>2</td>
 * <td>lower right corner, X position</td>
 * </tr>
 * <tr valign="top">
 * <td>3</td>
 * <td>lower right corner, Y position</td>
 * </tr>
 * <tr valign="top">
 * <td>4</td>
 * <td>upper right corner, X position</td>
 * </tr>
 * <tr valign="top">
 * <td>5</td>
 * <td>upper right corner, Y position</td>
 * </tr>
 * <tr valign="top">
 * <td>6</td>
 * <td>upper left corner, X position</td>
 * </tr>
 * <tr valign="top">
 * <td>7</td>
 * <td>upper left corner, Y position</td>
 * </tr>
 * </p>
 * <p>
 * The points are relative to the text regardless of the
 * <i>angle</i>, so "upper left" means in the top left-hand
 * corner seeing the text horizontally.
 */
function imagettfbbox ($size, $angle, $fontfile, $text) {}

/**
 * (PHP 4, PHP 5)<br/>
 * Write text to the image using TrueType fonts
 * @link http://php.net/manual/en/function.imagettftext.php
 * @param resource $image
 * @param float $size <p>The font size. Depending on your version of GD, this should be specified as the pixel size (GD1) or point size (GD2).</p>
 * @param float $angle <p>
 * The angle in degrees, with 0 degrees being left-to-right reading text.
 * Higher values represent a counter-clockwise rotation. For example, a
 * value of 90 would result in bottom-to-top reading text.
 * </p>
 * @param int $x <p>
 * The coordinates given by <i>x</i> and
 * <i>y</i> will define the basepoint of the first
 * character (roughly the lower-left corner of the character). This
 * is different from the <b>imagestring</b>, where
 * <i>x</i> and <i>y</i> define the
 * upper-left corner of the first character. For example, "top left"
 * is 0, 0.
 * </p>
 * @param int $y <p>
 * The y-ordinate. This sets the position of the fonts baseline, not the
 * very bottom of the character.
 * </p>
 * @param int $color <p>
 * The color index. Using the negative of a color index has the effect of
 * turning off antialiasing. See <b>imagecolorallocate</b>.
 * </p>
 * @param string $fontfile <p>
 * The path to the TrueType font you wish to use.
 * </p>
 * <p>
 * Depending on which version of the GD library PHP is using, when
 * <i>fontfile</i> does not begin with a leading
 * / then .ttf will be appended
 * to the filename and the library will attempt to search for that
 * filename along a library-defined font path.
 * </p>
 * <p>
 * When using versions of the GD library lower than 2.0.18, a space character,
 * rather than a semicolon, was used as the 'path separator' for different font files.
 * Unintentional use of this feature will result in the warning message:
 * Warning: Could not find/open font. For these affected versions, the
 * only solution is moving the font to a path which does not contain spaces.
 * </p>
 * <p>
 * In many cases where a font resides in the same directory as the script using it
 * the following trick will alleviate any include problems.
 * <code>
 * // Set the enviroment variable for GD
 * putenv('GDFONTPATH=' . realpath('.'));
 * // Name the font to be used (note the lack of the .ttf extension)
 * $font = 'SomeFont';
 * </code>
 * </p>
 * @param string $text <p>
 * The text string in UTF-8 encoding.
 * </p>
 * <p>
 * May include decimal numeric character references (of the form:
 * &#38;#38;#8364;) to access characters in a font beyond position 127.
 * The hexadecimal format (like &#38;#38;#xA9;) is supported.
 * Strings in UTF-8 encoding can be passed directly.
 * </p>
 * <p>
 * Named entities, such as &#38;#38;copy;, are not supported. Consider using
 * <b>html_entity_decode</b>
 * to decode these named entities into UTF-8 strings.
 * </p>
 * <p>
 * If a character is used in the string which is not supported by the
 * font, a hollow rectangle will replace the character.
 * </p>
 * @return array an array with 8 elements representing four points making the
 * bounding box of the text. The order of the points is lower left, lower
 * right, upper right, upper left. The points are relative to the text
 * regardless of the angle, so "upper left" means in the top left-hand
 * corner when you see the text horizontally.
 * Returns <b>FALSE</b> on error.
 */
function imagettftext ($image, $size, $angle, $x, $y, $color, $fontfile, $text) {}

/**
 * (PHP 4 &gt;= 4.0.7, PHP 5)<br/>
 * Give the bounding box of a text using fonts via freetype2
 * @link http://php.net/manual/en/function.imageftbbox.php
 * @param float $size <p>The font size. Depending on your version of GD, this should be specified as the pixel size (GD1) or point size (GD2).</p>
 * @param float $angle <p>
 * Angle in degrees in which <i>text</i> will be
 * measured.
 * </p>
 * @param string $fontfile <p>
 * The name of the TrueType font file (can be a URL). Depending on
 * which version of the GD library that PHP is using, it may attempt to
 * search for files that do not begin with a leading '/' by appending
 * '.ttf' to the filename and searching along a library-defined font path.
 * </p>
 * @param string $text <p>
 * The string to be measured.
 * </p>
 * @param array $extrainfo [optional] <p>
 * <table>
 * Possible array indexes for <i>extrainfo</i>
 * <tr valign="top">
 * <td>Key</td>
 * <td>Type</td>
 * <td>Meaning</td>
 * </tr>
 * <tr valign="top">
 * <td>linespacing</td>
 * <td>float</td>
 * <td>Defines drawing linespacing</td>
 * </tr>
 * </table>
 * </p>
 * @return array <b>imageftbbox</b> returns an array with 8
 * elements representing four points making the bounding box of the
 * text:
 * <tr valign="top">
 * <td>0</td>
 * <td>lower left corner, X position</td>
 * </tr>
 * <tr valign="top">
 * <td>1</td>
 * <td>lower left corner, Y position</td>
 * </tr>
 * <tr valign="top">
 * <td>2</td>
 * <td>lower right corner, X position</td>
 * </tr>
 * <tr valign="top">
 * <td>3</td>
 * <td>lower right corner, Y position</td>
 * </tr>
 * <tr valign="top">
 * <td>4</td>
 * <td>upper right corner, X position</td>
 * </tr>
 * <tr valign="top">
 * <td>5</td>
 * <td>upper right corner, Y position</td>
 * </tr>
 * <tr valign="top">
 * <td>6</td>
 * <td>upper left corner, X position</td>
 * </tr>
 * <tr valign="top">
 * <td>7</td>
 * <td>upper left corner, Y position</td>
 * </tr>
 * </p>
 * <p>
 * The points are relative to the text regardless of the
 * <i>angle</i>, so "upper left" means in the top left-hand
 * corner seeing the text horizontally.
 */
function imageftbbox ($size, $angle, $fontfile, $text, array $extrainfo = null) {}

/**
 * (PHP 4 &gt;= 4.0.7, PHP 5)<br/>
 * Write text to the image using fonts using FreeType 2
 * @link http://php.net/manual/en/function.imagefttext.php
 * @param resource $image
 * @param float $size <p>
 * The font size to use in points.
 * </p>
 * @param float $angle <p>
 * The angle in degrees, with 0 degrees being left-to-right reading text.
 * Higher values represent a counter-clockwise rotation. For example, a
 * value of 90 would result in bottom-to-top reading text.
 * </p>
 * @param int $x <p>
 * The coordinates given by <i>x</i> and
 * <i>y</i> will define the basepoint of the first
 * character (roughly the lower-left corner of the character). This
 * is different from the <b>imagestring</b>, where
 * <i>x</i> and <i>y</i> define the
 * upper-left corner of the first character. For example, "top left"
 * is 0, 0.
 * </p>
 * @param int $y <p>
 * The y-ordinate. This sets the position of the fonts baseline, not the
 * very bottom of the character.
 * </p>
 * @param int $color <p>
 * The index of the desired color for the text, see
 * <b>imagecolorexact</b>.
 * </p>
 * @param string $fontfile <p>
 * The path to the TrueType font you wish to use.
 * </p>
 * <p>
 * Depending on which version of the GD library PHP is using, when
 * <i>fontfile</i> does not begin with a leading
 * / then .ttf will be appended
 * to the filename and the library will attempt to search for that
 * filename along a library-defined font path.
 * </p>
 * <p>
 * When using versions of the GD library lower than 2.0.18, a space character,
 * rather than a semicolon, was used as the 'path separator' for different font files.
 * Unintentional use of this feature will result in the warning message:
 * Warning: Could not find/open font. For these affected versions, the
 * only solution is moving the font to a path which does not contain spaces.
 * </p>
 * <p>
 * In many cases where a font resides in the same directory as the script using it
 * the following trick will alleviate any include problems.
 * <code>
 * // Set the enviroment variable for GD
 * putenv('GDFONTPATH=' . realpath('.'));
 * // Name the font to be used (note the lack of the .ttf extension)
 * $font = 'SomeFont';
 * </code>
 * </p>
 * @param string $text <p>
 * Text to be inserted into image.
 * </p>
 * @param array $extrainfo [optional] <p>
 * <table>
 * Possible array indexes for <i>extrainfo</i>
 * <tr valign="top">
 * <td>Key</td>
 * <td>Type</td>
 * <td>Meaning</td>
 * </tr>
 * <tr valign="top">
 * <td>linespacing</td>
 * <td>float</td>
 * <td>Defines drawing linespacing</td>
 * </tr>
 * </table>
 * </p>
 * @return array This function returns an array defining the four points of the box, starting in the lower left and moving counter-clockwise:
 * <tr valign="top">
 * <td>0</td>
 * <td>lower left x-coordinate</td>
 * </tr>
 * <tr valign="top">
 * <td>1</td>
 * <td>lower left y-coordinate</td>
 * </tr>
 * <tr valign="top">
 * <td>2</td>
 * <td>lower right x-coordinate</td>
 * </tr>
 * <tr valign="top">
 * <td>3</td>
 * <td>lower right y-coordinate</td>
 * </tr>
 * <tr valign="top">
 * <td>4</td>
 * <td>upper right x-coordinate</td>
 * </tr>
 * <tr valign="top">
 * <td>5</td>
 * <td>upper right y-coordinate</td>
 * </tr>
 * <tr valign="top">
 * <td>6</td>
 * <td>upper left x-coordinate</td>
 * </tr>
 * <tr valign="top">
 * <td>7</td>
 * <td>upper left y-coordinate</td>
 * </tr>
 */
function imagefttext ($image, $size, $angle, $x, $y, $color, $fontfile, $text, array $extrainfo = null) {}

/**
 * (PHP 4 &gt;= 4.0.2, PHP 5)<br/>
 * Return the image types supported by this PHP build
 * @link http://php.net/manual/en/function.imagetypes.php
 * @return int a bit-field corresponding to the image formats supported by the
 * version of GD linked into PHP. The following bits are returned,
 * <b>IMG_GIF</b> | <b>IMG_JPG</b> |
 * <b>IMG_PNG</b> | <b>IMG_WBMP</b> |
 * <b>IMG_XPM</b>.
 */
function imagetypes () {}

/**
 * (PHP 4 &gt;= 4.0.5, PHP 5)<br/>
 * Convert JPEG image file to WBMP image file
 * @link http://php.net/manual/en/function.jpeg2wbmp.php
 * @param string $jpegname <p>
 * Path to JPEG file.
 * </p>
 * @param string $wbmpname <p>
 * Path to destination WBMP file.
 * </p>
 * @param int $dest_height <p>
 * Destination image height.
 * </p>
 * @param int $dest_width <p>
 * Destination image width.
 * </p>
 * @param int $threshold <p>
 * Threshold value, between 0 and 8 (inclusive).
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function jpeg2wbmp ($jpegname, $wbmpname, $dest_height, $dest_width, $threshold) {}

/**
 * (PHP 4 &gt;= 4.0.5, PHP 5)<br/>
 * Convert PNG image file to WBMP image file
 * @link http://php.net/manual/en/function.png2wbmp.php
 * @param string $pngname <p>
 * Path to PNG file.
 * </p>
 * @param string $wbmpname <p>
 * Path to destination WBMP file.
 * </p>
 * @param int $dest_height <p>
 * Destination image height.
 * </p>
 * @param int $dest_width <p>
 * Destination image width.
 * </p>
 * @param int $threshold <p>
 * Threshold value, between 0 and 8 (inclusive).
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function png2wbmp ($pngname, $wbmpname, $dest_height, $dest_width, $threshold) {}

/**
 * (PHP 4 &gt;= 4.0.5, PHP 5)<br/>
 * Output image to browser or file
 * @link http://php.net/manual/en/function.image2wbmp.php
 * @param resource $image
 * @param string $filename [optional] <p>
 * Path to the saved file. If not given, the raw image stream will be
 * output directly.
 * </p>
 * @param int $threshold [optional] <p>
 * Threshold value, between 0 and 255 (inclusive).
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function image2wbmp ($image, $filename = null, $threshold = null) {}

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Set the alpha blending flag to use the bundled libgd layering effects
 * @link http://php.net/manual/en/function.imagelayereffect.php
 * @param resource $image
 * @param int $effect <p>
 * One of the following constants:
 * <b>IMG_EFFECT_REPLACE</b>
 * Use pixel replacement (equivalent of passing <b>TRUE</b> to
 * <b>imagealphablending</b>)
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagelayereffect ($image, $effect) {}

/**
 * (PHP 5)<br/>
 * Output an XBM image to browser or file
 * @link http://php.net/manual/en/function.imagexbm.php
 * @param resource $image
 * @param string $filename <p>The path to save the file to. If not set or <b>NULL</b>, the raw image stream will be outputted directly.</p>
 * @param int $foreground [optional] <p>
 * You can set the foreground color with this parameter by setting an
 * identifier obtained from <b>imagecolorallocate</b>.
 * The default foreground color is black. All other colors are treated as
 * background.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagexbm ($image, $filename, $foreground = null) {}

/**
 * (PHP 4 &gt;= 4.3.0, PHP 5)<br/>
 * Makes the colors of the palette version of an image more closely match the true color version
 * @link http://php.net/manual/en/function.imagecolormatch.php
 * @param resource $image1 <p>
 * A truecolor image link resource.
 * </p>
 * @param resource $image2 <p>
 * A palette image link resource pointing to an image that has the same
 * size as <i>image1</i>.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagecolormatch ($image1, $image2) {}

/**
 * (PHP 5)<br/>
 * Applies a filter to an image
 * @link http://php.net/manual/en/function.imagefilter.php
 * @param resource $image
 * @param int $filtertype <p>
 * <i>filtertype</i> can be one of the following:
 * <b>IMG_FILTER_NEGATE</b>: Reverses all colors of
 * the image.
 * @param int $arg1 [optional] <p>
 * <b>IMG_FILTER_BRIGHTNESS</b>: Brightness level.
 * @param int $arg2 [optional] <p>
 * <b>IMG_FILTER_COLORIZE</b>: Value of green component.
 * @param int $arg3 [optional] <p>
 * <b>IMG_FILTER_COLORIZE</b>: Value of blue component.
 * @param int $arg4 [optional] <p>
 * <b>IMG_FILTER_COLORIZE</b>: Alpha channel, A value
 * between 0 and 127. 0 indicates completely opaque while 127 indicates
 * completely transparent.
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imagefilter ($image, $filtertype, $arg1 = null, $arg2 = null, $arg3 = null, $arg4 = null) {}

/**
 * (PHP 5 &gt;= 5.1.0)<br/>
 * Apply a 3x3 convolution matrix, using coefficient and offset
 * @link http://php.net/manual/en/function.imageconvolution.php
 * @param resource $image
 * @param array $matrix <p>
 * A 3x3 matrix: an array of three arrays of three floats.
 * </p>
 * @param float $div <p>
 * The divisor of the result of the convolution, used for normalization.
 * </p>
 * @param float $offset <p>
 * Color offset.
 * </p>
 * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
 */
function imageconvolution ($image, array $matrix, $div, $offset) {}


/**
 * Used as a return value by <b>imagetypes</b>
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_GIF', 1);

/**
 * Used as a return value by <b>imagetypes</b>
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_JPG', 2);

/**
 * Used as a return value by <b>imagetypes</b>
 * <p>
 * This constant has the same value as <b>IMG_JPG</b>
 * </p>
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_JPEG', 2);

/**
 * Used as a return value by <b>imagetypes</b>
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_PNG', 4);

/**
 * Used as a return value by <b>imagetypes</b>
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_WBMP', 8);

/**
 * Used as a return value by <b>imagetypes</b>
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_XPM', 16);

/**
 * Special color option which can be used in stead of color allocated with
 * <b>imagecolorallocate</b> or
 * <b>imagecolorallocatealpha</b>
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_COLOR_TILED', -5);

/**
 * Special color option which can be used in stead of color allocated with
 * <b>imagecolorallocate</b> or
 * <b>imagecolorallocatealpha</b>
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_COLOR_STYLED', -2);

/**
 * Special color option which can be used in stead of color allocated with
 * <b>imagecolorallocate</b> or
 * <b>imagecolorallocatealpha</b>
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_COLOR_BRUSHED', -3);

/**
 * Special color option which can be used in stead of color allocated with
 * <b>imagecolorallocate</b> or
 * <b>imagecolorallocatealpha</b>
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_COLOR_STYLEDBRUSHED', -4);

/**
 * Special color option which can be used in stead of color allocated with
 * <b>imagecolorallocate</b> or
 * <b>imagecolorallocatealpha</b>
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_COLOR_TRANSPARENT', -6);

/**
 * A style constant used by the <b>imagefilledarc</b> function.
 * <p>
 * This constant has the same value as <b>IMG_ARC_PIE</b>
 * </p>
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_ARC_ROUNDED', 0);

/**
 * A style constant used by the <b>imagefilledarc</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_ARC_PIE', 0);

/**
 * A style constant used by the <b>imagefilledarc</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_ARC_CHORD', 1);

/**
 * A style constant used by the <b>imagefilledarc</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_ARC_NOFILL', 2);

/**
 * A style constant used by the <b>imagefilledarc</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_ARC_EDGED', 4);

/**
 * A type constant used by the <b>imagegd2</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_GD2_RAW', 1);

/**
 * A type constant used by the <b>imagegd2</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_GD2_COMPRESSED', 2);

/**
 * Used together with <b>imageflip</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FLIP_HORIZONTAL', 1);

/**
 * Used together with <b>imageflip</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FLIP_VERTICAL', 2);

/**
 * Used together with <b>imageflip</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FLIP_BOTH', 3);

/**
 * Alpha blending effect used by the <b>imagelayereffect</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_EFFECT_REPLACE', 0);

/**
 * Alpha blending effect used by the <b>imagelayereffect</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_EFFECT_ALPHABLEND', 1);

/**
 * Alpha blending effect used by the <b>imagelayereffect</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_EFFECT_NORMAL', 2);

/**
 * Alpha blending effect used by the <b>imagelayereffect</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_EFFECT_OVERLAY', 3);
define ('IMG_CROP_DEFAULT', 0);
define ('IMG_CROP_TRANSPARENT', 1);
define ('IMG_CROP_BLACK', 2);
define ('IMG_CROP_WHITE', 3);
define ('IMG_CROP_SIDES', 4);
define ('IMG_CROP_THRESHOLD', 5);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_BELL', 1);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_BESSEL', 2);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_BILINEAR_FIXED', 3);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_BICUBIC', 4);
define ('IMG_BICUBIC_FIXED', 5);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_BLACKMAN', 6);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_BOX', 7);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_BSPLINE', 8);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_CATMULLROM', 9);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_GAUSSIAN', 10);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_GENERALIZED_CUBIC', 11);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_HERMITE', 12);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_HAMMING', 13);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_HANNING', 14);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_MITCHELL', 15);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_POWER', 17);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_QUADRATIC', 18);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_SINC', 19);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_NEAREST_NEIGHBOUR', 16);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_WEIGHTED4', 21);

/**
 * Used together with <b>imagesetinterpolation</b>, available as of PHP 5.5.0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_TRIANGLE', 20);
define ('IMG_AFFINE_TRANSLATE', 0);
define ('IMG_AFFINE_SCALE', 1);
define ('IMG_AFFINE_ROTATE', 2);
define ('IMG_AFFINE_SHEAR_HORIZONTAL', 3);
define ('IMG_AFFINE_SHEAR_VERTICAL', 4);

/**
 * When the bundled version of GD is used this is 1 otherwise
 * its set to 0.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('GD_BUNDLED', 0);

/**
 * Special GD filter used by the <b>imagefilter</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FILTER_NEGATE', 0);

/**
 * Special GD filter used by the <b>imagefilter</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FILTER_GRAYSCALE', 1);

/**
 * Special GD filter used by the <b>imagefilter</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FILTER_BRIGHTNESS', 2);

/**
 * Special GD filter used by the <b>imagefilter</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FILTER_CONTRAST', 3);

/**
 * Special GD filter used by the <b>imagefilter</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FILTER_COLORIZE', 4);

/**
 * Special GD filter used by the <b>imagefilter</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FILTER_EDGEDETECT', 5);

/**
 * Special GD filter used by the <b>imagefilter</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FILTER_GAUSSIAN_BLUR', 7);

/**
 * Special GD filter used by the <b>imagefilter</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FILTER_SELECTIVE_BLUR', 8);

/**
 * Special GD filter used by the <b>imagefilter</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FILTER_EMBOSS', 6);

/**
 * Special GD filter used by the <b>imagefilter</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FILTER_MEAN_REMOVAL', 9);

/**
 * Special GD filter used by the <b>imagefilter</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FILTER_SMOOTH', 10);

/**
 * Special GD filter used by the <b>imagefilter</b> function.
 * (Available as of PHP 5.3.0)
 * @link http://php.net/manual/en/image.constants.php
 */
define ('IMG_FILTER_PIXELATE', 11);

/**
 * The GD version PHP was compiled against.
 * (Available as of PHP 5.2.4)
 * @link http://php.net/manual/en/image.constants.php
 */
define ('GD_VERSION', "2.1.1-dev");

/**
 * The GD major version PHP was compiled against.
 * (Available as of PHP 5.2.4)
 * @link http://php.net/manual/en/image.constants.php
 */
define ('GD_MAJOR_VERSION', 2);

/**
 * The GD minor version PHP was compiled against.
 * (Available as of PHP 5.2.4)
 * @link http://php.net/manual/en/image.constants.php
 */
define ('GD_MINOR_VERSION', 1);

/**
 * The GD release version PHP was compiled against.
 * (Available as of PHP 5.2.4)
 * @link http://php.net/manual/en/image.constants.php
 */
define ('GD_RELEASE_VERSION', 0);

/**
 * The GD "extra" version (beta/rc..) PHP was compiled against.
 * (Available as of PHP 5.2.4)
 * @link http://php.net/manual/en/image.constants.php
 */
define ('GD_EXTRA_VERSION', "dev");

/**
 * A special PNG filter, used by the <b>imagepng</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('PNG_NO_FILTER', 0);

/**
 * A special PNG filter, used by the <b>imagepng</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('PNG_FILTER_NONE', 8);

/**
 * A special PNG filter, used by the <b>imagepng</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('PNG_FILTER_SUB', 16);

/**
 * A special PNG filter, used by the <b>imagepng</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('PNG_FILTER_UP', 32);

/**
 * A special PNG filter, used by the <b>imagepng</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('PNG_FILTER_AVG', 64);

/**
 * A special PNG filter, used by the <b>imagepng</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('PNG_FILTER_PAETH', 128);

/**
 * A special PNG filter, used by the <b>imagepng</b> function.
 * @link http://php.net/manual/en/image.constants.php
 */
define ('PNG_ALL_FILTERS', 248);

// End of gd v.
?>
