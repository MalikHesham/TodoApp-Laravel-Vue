<template>
    <!-- Create New Todo Part-->
    <div class="w-50 container">
        <form @submit.prevent="postNewTodo">
            <div class="input-group mb-3 w-100 mt-3">
                <input
                    v-model="form.title"
                    :class="{ 'is-invalid': form.errors.hasErrors('title') }"
                    @keydown="form.errors.clearErrors('title')"
                    type="text"
                    class="form-control"
                    id="exampleFormControlInput1"
                    placeholder="Ex: get better in front-end"
                />

                <button
                    class="btn btn-success btn-sm"
                    type="submit"
                    id="button-addon2"
                >
                    Create New Todo
                </button>
            </div>
        </form>
        <!-- Error message div -->
        <div
            class="card w-100 alert alert-danger alert-sm"
            role="alert"
            v-if="form.errors.hasErrors('title')"
        >
            <ul>
                <li>
                    <p
                        v-text="form.errors.getErrors('title')"
                        class="text-danger"
                    ></p>
                </li>
            </ul>
        </div>

        <!-- The rest of the CRUD operations table -->
        <div class="w-50">
            <div v-for="todo in allTodos" :key="todo.id" class="w-100">
                {{ todo.title }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: new Form({
                title: ""
            }),
            allTodos: ""
        };
    },
    methods: {
        getAllTodos() {
            axios
                .get("/api/todo")
                .then(res => {
                    this.allTodos = res.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        postNewTodo() {
            let data = new FormData();
            data.append("title", this.form.title);
            axios
                .post("/api/todo", data)
                .then(res => {
                    this.form.resetFormData();
                    this.getAllTodos();
                })
                .catch(error => {
                    this.form.errors.setErrors(error.response.data.errors);
                });
        }
    },
    mounted() {
        this.getAllTodos();
    }
};
</script>
