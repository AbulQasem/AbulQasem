<template>
    <div>
        <nav-bar></nav-bar>

        <v-card>
            <v-card-title>
                Profesores
                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    single-line
                    hide-details
                ></v-text-field>
            </v-card-title>

            <v-data-table
                dense
                :headers="headers"
                :items="profesores"
                :items-per-page="15"
                item-key="id"
                class="elevation-1 arabic-text"
                :search="search"
            >
                <template v-slot:item.actions="{ item }">
                    <v-icon small class="mr-2" @click="editItem(item)">
                        mdi-pencil
                    </v-icon>

                    <v-icon small @click="goToFile(item)">
                        mdi-eye
                    </v-icon>

                    <v-icon small @click="deleteItem(item)">
                        mdi-delete
                    </v-icon>
                </template>
            </v-data-table>

            <v-dialog v-model="dialog" max-width="800px">
                <v-card>
                    <v-card-title>
                        <span class="text-h5"> Editar datos del Alumno/a</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-text-field
                                        id="name"
                                        name="name"
                                        placeholder="Nombre"
                                        label="Nombre Alumno/a"
                                        v-model="editedItem.name"
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field
                                        id="apellido"
                                        name="apellido"
                                        placeholder="Apellido"
                                        label="Apellido Alumno/a"
                                        v-model="editedItem.surname"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-text-field
                                        id="name_ar"
                                        name="name_ar"
                                        placeholder="اسم"
                                        label="اسم"
                                        v-model="editedItem.name_ar"
                                        class="arabic-text"
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field
                                        id="apellido_ar"
                                        name="apellido_ar"
                                        placeholder="لقب"
                                        label="لقب"
                                        v-model="editedItem.surname_ar"
                                        class="arabic-text"
                                    ></v-text-field>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" text @click="close">
                            Cancel
                        </v-btn>
                        <v-btn color="blue darken-1" text @click="save">
                            Save
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-card>
    </div>
</template>

<script>
import NavBar from "../NavBar.vue";
export default {
    components: { NavBar },
    name: "profesores",
    data() {
        return {
            editedIndex: -1,
            editedItem: {},
            search: "",
            dialog: false,
            profesores: [],
            headers: [
                { text: "Id", value: "id" },
                { text: "Nombre", value: "name" },
                { text: "Apellido", value: "surname" },
                { text: "الإسم", value: "name_ar" },
                { text: "اللقب", value: "surname_ar" },
                { text: "Telefono", value: "telefono" },
                { text: "Correo", value: "email" },
                { text: "Actions", value: "actions", sortable: false }
            ]
        };
    },
    methods: {
        getProfesores() {
            axios.get("api/profesores").then(response => {
                this.profesores = response.data.data;
            });
        },
        editItem(item) {
            this.editedIndex = this.profesores.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        close() {
            this.dialog = false;
        },
        save() {
            this.submitForm();
            this.close();
        },
        submitForm() {
            console.log(this.editedItem);
            axios
                .put("api/profesores/" + this.editedItem.id, this.editedItem)
                .then(response => {
                    if (response.status === 200) {
                        this.getPro();
                    }
                })
                .catch(error => {
                    console.log(this.$data);
                })
                .finally(() => {});
        },
        goToFile(item) {
            this.$router.push("/profesores/" + item.id);
        }
    },
    created() {
        this.getProfesores();
    }
};
</script>

<style>
@font-face {
    font-family: "Janna";
    src: url("../../../../public/fonts/Janna LT Bold.ttf");
}

.arabic-text {
    font-family: "Janna";
}
</style>
