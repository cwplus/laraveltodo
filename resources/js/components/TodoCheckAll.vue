<template>
    <div class="check-all"><label><button class="toggle-all" @change="allChecked">All</button></label></div>
</template>

<script>
    export default {
        name: "TodoCheckAll",
        data(){
            return {
                anyRemaining: 0
            }
        },
        methods: {
            allChecked: function(){
                eventBus.$emit('checkAll')
            }
        }
    }
</script>

<style lang="scss" scoped>
 .check-all{


     .toggle-all{
         width: 50px;
         height: 50px;
         font-weight: bold;
         font-size: 22px;
         cursor: pointer;
         background-color: #FFCE00;
         color: #000;
         border: none;
         outline: none;
         line-height: 1;
         &:hover{
              background-color: lighten($color: #FFCE00, $amount: 10)
          }
         &:active{
              background-color: darken($color: #FFCE00, $amount: 5 )
          }
     }
 }
</style>