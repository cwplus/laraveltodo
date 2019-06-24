<template>
    <div class="todo-item">
        <div class="todo-left">
            <label class="input-check">
                <input type="checkbox" v-model="completed">
                #{{ todo.id }} -
            </label>
            <span class="todo-label" v-if="!editing" @dblclick="editTodo" :class="{completed: completed}"> {{ name }}</span>
            <input v-else class="todo-edit" type="text" v-model="name" @blur="SubmitEdit" @keyup.enter="SubmitEdit" @keyup.esc="cancelEdit" v-focus>
        </div>
        <div class="todo-right">
            <span class="remove-item" @click="removeTodo(index)">&times;</span>
        </div>
    </div>

</template>

<script>
    /* eslint-disable */
    import _ from 'lodash'
    export default {
        name: "Todo",
        props: {
            todo:{
                type: Object,
                required: true
            },
            index: {
                type: Number,
                required: true,
            },
        },
        data(){
            return {
                id: this.todo.id,
                name: this.todo.name,
                completed: this.todo.completed,
                editing: this.todo.editing,
                beforeEditName: '',
            }
        },
        directives: {
            focus: {
                inserted: function (el) {
                    el.focus()
                }
            }
        },
        methods: {
            editTodo(){
                this.beforeEditName = this.name
                this.editing = true
            },
            removeTodo(index){

            },
            SubmitEdit(){

                this.name = _.trim(this.name);
                if(_.isEmpty(this.name)) {
                    this.name = this.beforeEditName
                } else {
                    this.todo.name = this.name
                    this.todo.editing = false
                    eventBus.$emit('updateTodo',{
                        index: this.index,
                        todo: this.todo
                    })
                }
                this.beforeEditName = ''
                this.editing = false
            },
            cancelEdit(){
                this.name = this.beforeEditName
                this.beforeEditName = ''
                this.editing = false
            }
        }
    }
</script>

<style lang="scss" scoped>
    /*.todo{
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }*/
    .todo-item{
        display: flex;
        flex-direction: row;
        .remove-item {
            cursor: pointer;
            margin-left: 14px;
            &:hover{
                color: #FF0000;
            }
        }
        .todo-left{
/*            display: flex;
            flex-direction: row;*/
            align-items: center;
            width: 95%;
            .todo-label{
                margin-left: 2px;
            }
            .input-check{
                width: 15%;
            }
            .todo-edit{
                font-size: 16px;
                color: #2c3e50;
                width: auto;
                //margin-left: 12px;
                //width: 100%;
                //padding: 10px;
                //border: 1px solid #ccc;
                //font-family: 'Avenir', Helvetica, Arial, sans-serif;
                &:focus{
                    outline: none;
                }
            }
        }
        .todo-right{



        }
    }
    .completed{
        text-decoration: line-through;
        color: gray;
    }
</style>