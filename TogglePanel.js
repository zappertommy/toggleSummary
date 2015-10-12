(function($) {
    
    $.togglePanel = function(panel) {
        var plugin = this;
        var btn;
        var side;
        var expand_state = true;
        var summary = $('[data-section=summary]');
        var main_content = $('[data-section=main-content]');
        var max_width;
        var min_width;
        
        plugin.init = function() {

            expand_state = (panel.attr('data-expand') == 'true') ? true : false;
            side = panel.attr('data-side');
            btn = panel.find('.toggle-panel-action');
            min_width = btn.width() + 'px';

            togglePanel();
            panel.removeClass('hide');
        }

        var togglePanel = function() {

            if (expand_state) {
                expandPanel();

                return;
            }

            collapsePanel();
        }

        function expandPanel() {
            toggleButton();
            summary.addClass('hide');
            main_content.removeClass('hide');
            setWidth();
        }

        function collapsePanel() {
            toggleButton();
            summary.removeClass('hide');
            main_content.addClass('hide');
            setWidth();
        }

        function toggleButton() {
            var type = getButtonType();
            btn.find('span').removeClass('glyphicon-chevron-left glyphicon-chevron-right').addClass('glyphicon-chevron-'+type);
        }

        function setWidth() {
            if (expand_state) {
                panel.attr('style', '');
                
                return;
            }
            panel.css({width: min_width});
        }
        
        var getButtonType = function() {
            var type = 'left';
            
            if (side == 'left') {
                if (!expand_state) {
                    type = 'right';
                }
            } else {
                if (expand_state) {
                    type = 'right';
                }
            }
            
            return type;
        }
        
        plugin.init();
        
        btn.click(function(){
            expand_state = !expand_state;
            togglePanel();
        });
    };
    
    $.fn.togglePanel = function(options) {
        if (undefined == $(this).data('togglePanel')) {
            var plugin = new $.togglePanel(this, options);
            $(this).data('togglePanel', plugin);
        }
    };
}(jQuery));