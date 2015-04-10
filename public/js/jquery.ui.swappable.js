
(function($) {

$.swappable = function(options) {
    var $droppableParent;

    $(options.container+' '+options.element+' '+options.handle).css('cursor','move');
    $(options.container+' '+options.element).draggable({
        revert: 'invalid',
        revertDuration: 200,
        start: function () {
            $droppableParent = $(this).parents(options.container);
            $droppableParent.addClass('from-dragged');
            $(this).addClass('being-dragged');
        },
        stop: function () {
            $(this).removeClass('being-dragged');
            $droppableParent.removeClass('from-dragged');
        }
    });
    $(options.container).droppable({
        hoverClass: 'drop-hover',
        drop: function (event, ui) {
            var $draggable = $(ui.draggable[0]),
                draggableOffset = $draggable.offset(),
                container = $(event.target),
                containerOffset = container.offset(),
                $replacedElement = $(event.target).find(options.element);

            $replacedElement.
                appendTo($droppableParent);

            $draggable.
                appendTo(container).
                css({
                    left: draggableOffset.left - containerOffset.left,
                    top: draggableOffset.top - containerOffset.top
                }).
                animate({left: 0, top: 0}, 200);
            options.update(
                $draggable.attr(options.attribute),
                $replacedElement.attr(options.attribute)
            );
        }
    });
};


})(jQuery);
