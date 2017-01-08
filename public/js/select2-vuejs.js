Vue.component('select2',{
    template:'#select2-template',
    props:['placeholder','value'],
    mounted: function(){
        var vm = this;
        $(this.$el)
            .val(this.value)
            .select2()
            .on('select2:select',function(event){
                vm.$emit('input',event.target.value)
            })
    },
    watch:{
        value:function(value){
            $(this.$el).val(value).trigger('change');
        }
    }
});