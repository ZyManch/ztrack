/**
 * Created with PhpStorm.
 * User: ZyManch
 * Date: 21.06.14
 * Time: 11:27
 */
$(document).ready(function() {

    var $document = $(document),
        $image = $('.image'),
        $inputMarginLeft = $('#image-left'),
        $inputMarginRight = $('#image-right'),
        $inputMarginTop = $('#image-top'),
        $inputMarginBottom = $('#image-bottom'),
        $blockMarginLeft = $image.children('.block-left'),
        $blockMarginRight = $image.children('.block-right'),
        $blockMarginTop = $image.children('.block-top'),
        $blockMarginBottom = $image.children('.block-bottom'),
        width = $image.width(),
        height = $image.height(),
        originalWidth = parseInt($('#image-width').html().split(',').join(''), 10),
        zoom = width / originalWidth,
        ratio = parseFloat($('#image-ratio').attr('ratio')),
        fillMarginInputs = function(width, left, top) {

        },
        updateImageByInputs = function() {
            $blockMarginTop.css({
                height: Math.round($inputMarginTop.val()*zoom)+'px',
                left:   Math.round($inputMarginLeft.val()*zoom)+'px',
                right:  Math.round($inputMarginRight.val()*zoom)+'px'
            });
            $blockMarginBottom.css({
                height: Math.round($inputMarginBottom.val()*zoom)+'px',
                left:   Math.round($inputMarginLeft.val()*zoom)+'px',
                right:  Math.round($inputMarginRight.val()*zoom)+'px'
            });
            $blockMarginLeft.css('width', Math.round($inputMarginLeft.val()*zoom)+'px');
            $blockMarginRight.css('width', Math.round($inputMarginRight.val()*zoom)+'px');
        };
    Math.between = function(value, min, max) {
        if (value < min) {
            return Math.round(min);
        } else if (value > max) {
            return Math.round(max);
        }
        return Math.round(value);
    }
    updateImageByInputs();
    $inputMarginLeft.change(updateImageByInputs);
    $inputMarginRight.change(updateImageByInputs);
    $inputMarginTop.change(updateImageByInputs);
    $inputMarginBottom.change(updateImageByInputs);
    $image.mousedown(function(e) {
        var moving,
            startY = e.screenY,
            startX = e.screenX,
            startMarginLeft = parseInt($inputMarginLeft.val(), 10),
            startMarginTop = parseInt($inputMarginTop.val(), 10),
            startMarginBottom = parseInt($inputMarginBottom.val(), 10),
            startMarginRight = parseInt($inputMarginRight.val(), 10),
            dx,
            dy,
            maxMarginX = startMarginLeft + startMarginRight,
            maxMarginY = startMarginBottom + startMarginTop,
            position;

        if (e.srcElement.tagName.toLowerCase() == 'img' ) {
            // moving
            moving = function(e) {
                dx = (e.screenX - startX)/zoom;
                dy = (e.screenY - startY)/zoom;
                $inputMarginLeft.val(Math.between(startMarginLeft + dx , 0, maxMarginX));
                $inputMarginRight.val(Math.between(startMarginRight - dx,0,maxMarginX));
                $inputMarginTop.val(Math.between(startMarginTop + dy,0, maxMarginY));
                $inputMarginBottom.val(Math.between(startMarginBottom - dy,0, maxMarginY));
                updateImageByInputs();
            }
        } else {
            position = $(e.srcElement).position();
            if ((e.offsetX + position.left) / width < (e.offsetY + position.top) / height) {
                // left + bottom
                if ((e.offsetX + position.left) / width <  (height - (e.offsetY + position.top))/height) {
                    // left
                    moving = function(e) {
                        $inputMarginLeft.val(Math.round(startMarginLeft + (e.screenX - startX)/zoom));
                        $inputMarginBottom.val(Math.round(
                            (height-$inputMarginTop.val()*zoom-(width - $inputMarginLeft.val()*zoom - $inputMarginRight.val()*zoom)/ratio)/zoom
                        ));
                        updateImageByInputs();
                    }
                } else {
                    // bottom
                    moving = function(e) {
                        $inputMarginBottom.val(Math.round(startMarginBottom - (e.screenY - startY)/zoom));
                        $inputMarginRight.val(Math.round(
                            (width-$inputMarginLeft.val()*zoom-(height - $inputMarginTop.val()*zoom - $inputMarginBottom.val()*zoom)*ratio)/zoom
                        ));
                        updateImageByInputs();
                    }
                }
            } else {
                // right + top
                if ((width - (e.offsetX + position.left)) / width <  (e.offsetY + position.top)/height) {
                    // right
                    moving = function(e) {
                        $inputMarginRight.val(Math.round(startMarginRight - (e.screenX - startX)/zoom));
                        $inputMarginBottom.val(Math.round(
                            (height-$inputMarginTop.val()*zoom-(width - $inputMarginLeft.val()*zoom - $inputMarginRight.val()*zoom)/ratio)/zoom
                        ));
                        updateImageByInputs();
                    }
                } else {
                    // top
                    moving = function(e) {
                        $inputMarginTop.val(Math.round(startMarginTop + (e.screenY - startY)/zoom));
                        $inputMarginRight.val(Math.round(
                            (width-$inputMarginLeft.val()*zoom-(height - $inputMarginTop.val()*zoom - $inputMarginBottom.val()*zoom)*ratio)/zoom
                        ));
                        updateImageByInputs();
                    }
                }
            }
        }
        $document.mousemove(moving);
        $document.mouseup(function() {
            $document.unbind('mousemove');
            $document.unbind('mouseup');
        });
        return false;
    });

});