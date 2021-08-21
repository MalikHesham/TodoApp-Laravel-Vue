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
                    Create New Todo
                </button>
            </div>
        </form>
        <!-- Error message div -->
        <div
            class="card w-100 alert alert-danger alert-sm mb-1"
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
        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center">Task</th>
                    <th scope="col" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody v-for="todo in allTodos" :key="todo.id" class="w-100">
                <tr>
                    <!-- The todo status toggling -->
                    <td>
                        <span
                            v-if="
                                todo.is_todo_done == false && editing != todo.id
                            "
                        >
                            <i
                                class="far fa-circle  fakeCheckBox"
                                v-on:click="toggleTodoClick(todo)"
                            ></i>
                        </span>
                        <span v-if="todo.is_todo_done == true">
                            <i
                                v-on:click="toggleTodoClick(todo)"
                                class="far fa-check-circle fakeCheckBox"
                                style="color:#1aff1a"
                            >
                                Done
                            </i>
                        </span>
                    </td>
                    <!-- End of status toggling -->

                    <!-- The todo title text -->
                    <td class="text-center">
                        <s v-if="todo.is_todo_done" class="text-muted">
                            <h6>{{ todo.title }}</h6>
                        </s>

                        <span>
                            <h6
                                v-if="
                                    !todo.is_todo_done &&
                                        (editing == -1 || editing != todo.id)
                                "
                            >
                                {{ todo.title }}
                            </h6>
                            <input
                                type="text"
                                v-if="editing == todo.id && !is_todo_done"
                                v-model="todo.title"
                                @keydown="form.errors.clearErrors('title')"
                            />
                        </span>
                    </td>
                    <!-- End of todo title rendering -->

                    <!-- Actions: Editing and Deleting the todo -->
                    <td class="text-right">
                        <button
                            class="btn btn-warning btn-sm text-bolder"
                            v-if="editing != todo.id || editing == -1"
                            :disabled="todo.is_todo_done == 1"
                            v-on:click="editing = todo.id"
                        >
                            Edit <i class="far fa-edit"></i>
                        </button>

                        <button
                            class="btn btn-success btn-sm"
                            v-if="
                                editing == todo.id &&
                                    editing != -1 &&
                                    !todo.is_todo_done
                            "
                            v-on:click="updateTodo(todo)"
                        >
                            Update
                            <i class="fa fa-refresh" aria-hidden="true"></i>
                        </button>

                        <b-button
                            id="show-btn"
                            v-b-modal="'SecondaryModal' + todo.id"
                            class="btn-danger"
                        >
                            Delete <i class="far fa-trash-alt"></i>
                        </b-button>

                        <b-modal
                            :id="'SecondaryModal' + todo.id"
                            hide-footer
                            centered
                            no-stacking
                        >
                            <template #modal-title>
                                Deleting todo ...
                            </template>
                            <div class="d-block text-center">
                                <h5>
                                    Are you sure you want to delete the
                                    <span class="text-danger">{{
                                        todo.title
                                    }}</span>
                                    task?
                                </h5>
                            </div>
                            <div class="text-right">
                                <b-button
                                    class="mt-3"
                                    @click="
                                        $bvModal.hide(
                                            'SecondaryModal' + todo.id
                                        )
                                    "
                                    >Back</b-button
                                >
                                <b-button
                                    class="mt-3 btn-danger"
                                    @click="deleteTodo(todo)"
                                    >Confirm</b-button
                                >
                            </div>
                        </b-modal>
                    </td>
                    <!-- End of actions -->
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ["user", "user_id"],
    data() {
        return {
            form: new Form({
                title: ""
            }),
            allTodos: "",
            editing: -1
        };
    },
    created() {},
    methods: {
        getAllTodos() {
            axios
                .get(`/api/v1/user/${this.user_id}/todos`)
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
            data.append("user_id", this.user_id);
            axios
                .post(`/api/v1/user/${this.user_id}/todos`, data)
                .then(res => {
                    this.form.resetFormData();
                    this.getAllTodos();
                })
                .catch(error => {
                    this.form.errors.setErrors(error.response.data.errors);
                });
        },
        toggleTodoClick(event) {
            event.is_todo_done = !event.is_todo_done;
            let newData = new FormData();

            newData.append("_method", "PUT");
            event.is_todo_done == true && newData.append("is_todo_done", 1);
            event.is_todo_done == false && newData.append("is_todo_done", 0);

            axios.post(
                `api/v1/user/${this.user_id}/todos/${event.id}/state=${event.is_todo_done}`,
                newData
            );
        },
        updateTodo(event) {
            this.editing = -1;
            let data = new FormData();

            data.append("_method", "PUT");
            data.append("title", event.title);
            axios
                .post(`api/v1/user/${this.user_id}/todos/${event.id}`, data)
                .catch(error => {
                    this.form.errors.setErrors(error.response.data.errors);
                });
            this.getAllTodos();
        },
        deleteTodo(todo) {
            let data = new FormData();
            data.append("_method", "DELETE");
            axios
                .post(`api/v1/user/${this.user_id}/todos/${todo.id}`, data)
                .then(res => {
                    this.allTodos = res.data;
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
