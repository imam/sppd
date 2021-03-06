<!-- Core  -->
<script src="/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
<script src="/global/vendor/jquery/jquery.js"></script>
<script src="/global/vendor/tether/tether.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<script src="/global/vendor/animsition/animsition.js"></script>
<script src="/global/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
<script src="/global/vendor/asscrollable/jquery-asScrollable.js"></script>
<script src="/global/vendor/jquery-wizard/jquery-wizard.min.js"></script>
<script src="/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
<!-- Plugins -->
<script src="https://unpkg.com/vue@2.1.6/dist/vue.min.js"></script>
<script src="/global/vendor/switchery/switchery.min.js"></script>
<script src="/global/vendor/intro-js/intro.js"></script>
<script src="/global/vendor/screenfull/screenfull.js"></script>
<script src="/global/vendor/slidepanel/jquery-slidePanel.js"></script>
<script src="/global/vendor/select2/select2.min.js"></script>
<script src="/assets/js/jquery.maskMoney.js"></script>
<script src="/global/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="/global/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/global/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
<script src="/global/vendor/datatables-responsive/dataTables.responsive.js"></script>
<script src="/global/vendor/datatables-tabletools/dataTables.tableTools.js"></script>
<script src="/global/vendor/asscrollable/jquery-asScrollable.min.js"></script>
<script src="/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
<script src="/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
<script src="/global/vendor/summernote/summernote.min.js"></script>
<!-- Scripts -->
<script src="/global/js/State.js"></script>
<script src="/global/js/Component.js"></script>
<script src="/global/js/Plugin.js"></script>
<script src="/global/js/Base.js"></script>
<script src="/global/js/Config.js"></script>
<script src="/assets/js/Section/Menubar.js"></script>
<script src="/assets/js/Section/GridMenu.js"></script>
<script src="/assets/js/Section/Sidebar.js"></script>
<script src="/assets/js/Section/PageAside.js"></script>
<script src="/assets/js/Plugin/menu.js"></script>
<script src="/global/js/config/colors.js"></script>
<script src="/assets/js/config/tour.js"></script>
<script type="text/x-template" id="select2-template">
    <select class="form-control" data-plugin="select2"
            :data-placeholder="placeholder" style="width: 100%">
        <option value=""></option>
        <slot></slot>
    </select>
</script>
<script type="text/x-template" id="input_text">
    <input type="text" class="form-control" :placeholder="placeholder" style="text-align:left">
</script>
<script type="text/x-template" id="datepicker">
    <input type="text" :placeholder="placeholder" data-plugin="datepicker" class="form-control" data-format="dd/mm/yyyy">
</script>

<script>
    var csrf_token =   $('meta[name="csrf-token"]').attr('content');
</script>
<script>
    Config.set('assets', '/assets');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="/assets/js/accounting.min.js"></script>
<script>
    accounting.settings.currency.symbol = "Rp ";
    accounting.settings.currency.precision = 0;
    accounting.settings.currency.decimal = ",";
    accounting.settings.currency.thousand = ".";
</script>
<!-- Page -->
<script src="/global/vendor/notie/notie.js"></script>
<script src="https://unpkg.com/vue@2.1.6/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf_token;
</script>
<script src="/assets/js/Site.js"></script>

<script>
    (function(document, window, $) {
        'use strict';
        var Site = window.Site;
        $(document).ready(function() {
            Site.run();
            $('input[data-type=money]').maskMoney({
                prefix: 'Rp ',
                precision: 0
            });
        });
    })(document, window, jQuery);
</script>
<script src="/js/select2-vuejs.js"></script>
<script>
    function toggleFooter(){
        axios.post('/toggle_sidebar');
    }
    Vue.component('input_text',{
        template:'#input_text',
        props:['placeholder'],
        mounted:function(){
            var vm= this;
            $(this.$el)
                    .on('change',function(e){
                        vm.$emit('input',e.target.value)
                    })
        }
    });
    Vue.component('datepicker',{
        template:'#datepicker',
        props:['placeholder'],
        mounted:function() {
            var vm = this;
            $(this.$el)
                    .on('change', function (e) {
                        vm.$emit('input', e.target.value)
                    })
        }
    });
</script>
@yield('script')