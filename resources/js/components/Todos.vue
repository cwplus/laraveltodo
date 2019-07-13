<template>
    <section id="todos">
        <div class="todo" v-for="(todo, index) in todos" :key="todo.id">
        <Todo  :todo="todo" :index="index"></Todo>
        </div>
    </section>
</template>

<script>
    import Todo from "./Todo";

    export default {
        name: "Todos",
        props: ["todos"],
        components: {
            Todo: Todo
        },
        methods: {

        }
    }
</script>

<style lang="scss" scoped>
    #todos{
        display: flex;
        flex-direction: row;
        justify-content: center;
        flex-wrap: wrap;
        width: 100%;
        .todo{
            width: 24%;
            margin: 15px;
            padding: 15px;
            background-color: #FFF;
        }
    }
</style>