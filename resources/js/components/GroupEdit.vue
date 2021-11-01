<template>
    <!-- Para editar un grupo -->
    <v-dialog v-model="dialog" max-width="800px">
        <v-card>
            <v-card-title>
                <span class="text-h5"> Editar datos del profesor </span>
            </v-card-title>

            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" md="6">
                            <v-text-field
                                id="name"
                                name="name"
                                placeholder="Nombre"
                                label="Nombre del profesor"
                                v-model="editedItem.profesores_id"
                            ></v-text-field>
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
</template>

<script>
export default {
    
    name: "grupos",
    components: { NavBar, GroupForm },
    data() {
        return {
            dialog: false,
            dialogDelete: false,
            groupForm: false,
            search: "",
            grupos: [],
            profesores: [],
            editedIndex: -1,
            editedItem: {},

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
            this.$router.push("/grupos/" + item.id);
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
                })
                .finally(() => {
                    //Perform action in always
                });
            this.closeDelete();
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
        }
    },
    created() {
        this.getGrupos();
    }
};

</script>