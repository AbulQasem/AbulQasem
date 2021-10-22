<template>
    <div>
        <nav-bar></nav-bar>

        <!-- Render de grupos -->
        <v-card>
            <v-card-title>
                Grupos

                <v-btn
                    color="primary"
                    dark
                    type="submit"
                    @click="newGroup()"
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
                :items="grupos"
                item-key="id"
                class="elevation-1"
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
                </template></v-data-table
            >
        </v-card>

        <v-dialog v-model="dialog" max-width="800px">
            <v-card>
                <v-card-title>
                    <span class="text-h5"> Editar datos del Grupo</span>
                </v-card-title>

                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" md="6">
                                <v-select
                                    id="name"
                                    name="docent"
                                    placeholder="Nombre"
                                    label="Nombre del profesor"
                                    v-model="editedItem.profesores_id"
                                    :items="profesores"
                                    item-text="name"
                                    item-value="id"
                                ></v-select>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field
                                    id="horario"
                                    name="horario"
                                    placeholder="Horario"
                                    label="Horario"
                                    v-model="editedItem.horario"
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col cols="12" md="4">
                                <v-text-field
                                    id="dia"
                                    name="dia"
                                    placeholder="Dia"
                                    label="Dia"
                                    v-model="editedItem.dia"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="4">
                                <v-text-field
                                    id="aula"
                                    name="aula"
                                    placeholder="Aula"
                                    label="Aula"
                                    v-model="editedItem.aula"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="4">
                                <v-text-field
                                    id="nivel"
                                    name="nivel"
                                    placeholder="Nivel"
                                    label="Nivel"
                                    v-model="editedItem.nivel"
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

        <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
                <v-card-title class="text-h5"
                    >Are you sure you want to delete this item?</v-card-title
                >
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="closeDelete"
                        >Cancel</v-btn
                    >
                    <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                        >OK</v-btn
                    >
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <group-form
            :activate="groupForm"
            @close-form-event="closeForm"
        ></group-form>
    </div>
</template>

<script>
import NavBar from "../NavBar.vue";
import GroupForm from "../GroupForm.vue";

export default {
    name: "grupos",
    components: { NavBar, GroupForm },
    data() {
        return {
            days: [
                "LUNES",
                "MARTES",
                "MIÉRCOLES",
                "JUEVES",
                "VIERNES",
                "SÁBADO",
                "DOMINGO"
            ],

            times: ["11:00-13:15", "16:00-18:15", "17:00-19:15"],
            profesores: [],
            profesorSeleccionado: "",
            levels: ["0", "1", "2", "3"],
            aula: ["1", "2", "3", "4", "5"],
            grupo: {
                profesores_id: "",
                horario: "",
                dia: "",
                aula: "",
                nivel: ""
            },
            profesores: [],
            dialog: false,
            dialogDelete: false,
            groupForm: false,
            search: "",
            grupos: [],
            editedIndex: -1,
            editedItem: {},
            headers: [
                { text: "Id", value: "id" },
                { text: "Dia", value: "dia" },
                { text: "Horario", value: "horario" },
                { text: "Aula", value: "aula" },
                { text: "Nivel", value: "nivel" },
                { text: "Profesor", value: "name" },
                { text: "", value: "surname" },
                { text: "Actions", value: "actions", sortable: false }
            ]
        };
    },
    methods: {
        getGrupos() {
            axios.get("api/grupos").then(response => {
                this.grupos = response.data.data;
            });
        },
        getProfesores() {
            axios.get("api/profesores").then(response => {
                this.profesores = response.data.data;
            });
        },
        editItem(item) {
            this.editedIndex = this.grupos.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            this.editedIndex = this.grupos.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },
        goToFile(item) {
            this.$router.push("/grupo/" + item.id);
        },
        close() {
            this.dialog = false;
        },
        closeDelete() {
            this.dialogDelete = false;
        },
        deleteItemConfirm() {
            axios
                .delete("api/grupos/" + this.editedItem.id)
                .then(response => {
                    if (response.status === 200) {
                        this.getGrupos();
                    }
                })
                .catch(error => {
                    console.log("ERROR");
                })
                .finally(() => {
                    //Perform action in always
                });
            this.closeDelete();
        },
        submitForm() {
            // this.$v.$touch();

            // if (this.$v.$invalid) {
            //     this.$v.$touch();
            // } else {
            console.log(this.editedItem);
            console.log("api/grupos/" + this.editedItem.id);
            axios
                .put("api/grupos/" + this.editedItem.id, this.editedItem)
                .then(response => {
                    if (response.status === 200) {
                        this.getGrupos();
                    }
                })
                .catch(error => {
                    console.log(this.$data);
                })
                .finally(() => {
                    //Perform action in always
                });
        },
        newGroup() {
            this.groupForm = true;
        },
        save() {
            this.submitForm();
            this.close();
        },
        closeForm() {
            this.groupForm = false;
            this.getGrupos();
        }
    },
    created() {
        this.getGrupos();
        this.getProfesores();
    }
};
</script>

<style scoped></style>
