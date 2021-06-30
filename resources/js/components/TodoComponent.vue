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
                    placeholder="Ex: get better in front-end coloring"
                />
                <button
                    class="btn btn-success btn-sm border-success"
                    type="submit"
                    id="button-addon2"
                >
                    <strong>Create New Todo</strong>
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
        <table class="table table-hover table-primary">
            <thead>
                <tr>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center">Task to be done</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody v-for="todo in allTodos" :key="todo.id" class="w-100">
                <tr>
                    <!-- The todo status -->
                    <td v-if="todo.is_todo_done == false">
                        <i class="far fa-circle"></i>
                    </td>
                    <td v-if="todo.is_todo_done == true">
                        <a href="#">
                            <i
                                class="far fa-check-circle"
                                style="color:green"
                            ></i>
                        </a>
                    </td>

                    <!-- The todo text -->
                    <td class="text-center">{{ todo.title }}</td>

                    <td class="text-right">
                        <button class="btn btn-warning btn-sm text-bolder">
                            Edit <i class="far fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm">
                            Delete <i class="far fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ["user"],
    data() {
        return {
            form: new Form({
                title: ""
            }),
            allTodos: ""
        };
    },
    created() {
        console.log(this.user);
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
