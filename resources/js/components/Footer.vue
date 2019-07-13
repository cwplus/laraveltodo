<template>
    <div class="footer">
        <div class="wrapper">

        </div>
    </div>
</template>

<script>
    import TodoCheckAll from "./TodoCheckAll";
    import TodoFiltred from "./TodoFiltred";
    import TodoClearCompleted from "./TodoClearCompleted";
    import TodoItemsRemaining from "./TodoItemsRemaining";

    export default {
        name: "Footer",
        components:{
            TodoCheckAll: TodoCheckAll,
            TodoFiltred: TodoFiltred,
            TodoClearCompleted: TodoClearCompleted,
            TodoItemsRemaining: TodoItemsRemaining
        }
    }
</script>

<style lang="scss" scoped>

</style>