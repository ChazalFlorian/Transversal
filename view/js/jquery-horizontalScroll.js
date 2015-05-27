/**
 * Created by Kévin on 29/04/2015.
 */
(function($) {
    $.fn.mouseIncrement=function(min, max) {
        this.bind("mousewheel", function(event, delta) {
            if (delta > 0) {
                if (parseInt(this.value) < max) {
                    this.value = parseInt(this.value) + 1;
                }
            } else {
                if (parseInt(this.value) > min) {
                    this.value = parseInt(this.value) - 1;
                }
            }
            return false;
        });
    };
})(jQuery);