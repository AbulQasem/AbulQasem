<template>
    <div>
        <nav-bar></nav-bar>

        <v-card>
            <v-card-title>
                Profesores
                <v-btn
                    color="primary"
                    dark
                    type="submit"
                    @click="newProfesor()"
                    class="ml-4"
                >
                    +
                </v-btn>

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
                class="arabic-text"
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
                        <span class="text-h5">
                            Editar datos del Profesor/a</span
                        >
                    </v-card-title>

                    <v-card-text class="arabic-text">
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
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="6">
                                    <v-text-field
                                        id="apellido_ar"
                                        name="apellido_ar"
                                        placeholder="لقب"
                                        label="لقب"
                                        v-model="editedItem.surname_ar"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col cols="12" md="4">
                                    <v-text-field
                                        id="email"
                                        name="email"
                                        placeholder="Correo"
                                        label="E-mail"
                                        v-model="editedItem.email"
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="4">
                                    <v-text-field
                                        id="dni"
                                        name="dni"
                                        placeholder="DNI"
                                        label="DNI"
                                        v-model="editedItem.dni"
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="4">
                                    <v-text-field
                                        id="phone"
                                        name="telefono"
                                        placeholder="Telefono"
                                        label="Telefono"
                                        v-model="editedItem.telefono"
                                    ></v-text-field>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col cols="12" md="6">
                                    <v-text-field
                                        id="address"
                                        name="address"
                                        placeholder="Dirección"
                                        label="Dirección"
                                        v-model="editedItem.address"
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="3">
                                    <v-text-field
                                        id="city"
                                        name="city"
                                        placeholder="Ciudad"
                                        label="Ciudad"
                                        v-model="editedItem.city"
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="12" md="3">
                                    <v-text-field
                                        id="postalcode"
                                        name="postalcode"
                                        placeholder="CP"
                                        label="CP"
                                        v-model="editedItem.postalcode"
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

            <profesor-form
                :activate="profesorForm"
                @close-form-event="closeForm"
            ></profesor-form>
        </v-card>
    </div>
</template>

<script>
import NavBar from "../NavBar.vue";
import ProfesorForm from "../ProfesorForm.vue";

export default {
    components: { NavBar, ProfesorForm },
    name: "profesores",
    data() {
        return {
            editedIndex: -1,
            editedItem: {},
            search: "",
            dialog: false,
            profesorForm: false,
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
            axios
                .put("api/profesores/" + this.editedItem.id, this.editedItem)
                .then(response => {
                    if (response.status === 200) {
                        this.getProfesores();
                    }
                })
                .catch(error => {})
                .finally(() => {});
        },
        newProfesor() {
            this.profesorForm = true;
        },
        goToFile(item) {
            this.$router.push("/profesores/" + item.id);
        },
        closeForm() {
            this.profesorForm = false;
            this.getProfesores();
        }
    },
    created() {
        this.getProfesores();
    }
};
</script>

<style></style>
