
root = new Vue({
    el: '#root',
    data: $.extend(data,{meta:null,data_loaded: false,prev_loading:false,next_loading:false}),
    methods: {
        go_to_next_page: function(e){
            e.preventDefault();
            this.next_loading = true;
            axios.get(calendar_meta().next_page_url).then(function(response){
                this.meta = response.data;
                this.calendar_meta = calendar_meta();
                this.next_loading = false;
                console.log(response);
            }.bind(this));
        },
        go_to_prev_page: function(e){
            e.preventDefault();
            this.prev_loading =true;
            axios.get(calendar_meta().prev_page_url).then(function(response){
                this.meta = response.data;
                this.calendar_meta = calendar_meta();
                this.prev_loading=false;
                console.log(response);
            }.bind(this));
        }
    },
    computed:{
        next_page_exist:function(){
            if(this.meta != null){
                return this.calendar_meta.current_page != this.calendar_meta.last_page;
            }else{
                return false;
            }
        },
        prev_page_exist:function(){
            if(this.meta != null){
                return this.calendar_meta.current_page != 1;
            }else{
                return false;
            }
        }
    },
    filters:{
        accounting:function(value){
            return accounting.formatMoney(value,'Rp ',2,'.',',');
        }
    },
    name: 'halo'
});

axios.get(root.tableurl).then(function(response){
    root.meta = response.data;
    root.calendar_meta = calendar_meta();
    root.data_loaded =true;
    console.log(response);
});