const accordion = {
     $accordionTriggers: $('.accordion__intro'),

    init: function() {
        $accordionTriggers.on('click', function() {
            const $this = $(this);
            const $parent = $this.parents('.accordion');
            const $content = $parent.find('.accordion__content');

            $accordionTriggers.each(function() {
                if (this === $this[0]) {
                    $content.stop().slideToggle();
                } else {
                    $(this).parents('.accordion').find('.accordion__content').stop().slideUp();
                }
            });
        });
    }
}

export default accordion;