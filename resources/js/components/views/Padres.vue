<template>
    <div>
        <nav-bar></nav-bar>

        <v-card class="mx-auto mt-5" width="95%">
            <v-card-title>
                Padres
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
                :items="data.padres"
                :items-per-page="25"
                item-key="id"
                :search="search"
                @row-click="handleFunction"
                class="arabic-text"
            >
                <template v-slot:item.actions="{ item }">
                    <v-icon small class="mr-2" @click="editItem(item)">
                        mdi-pencil
                    </v-icon>

                    <v-icon small @click="goToFile(item)"> mdi-eye </v-icon>

                    <v-icon small @click="deleteItem(item)">
                        mdi-delete
                    </v-icon>
                </template>

                <template v-slot:item.pagado="{ item }">
                    <v-chip :color="getColor(item)" dark>
                        {{ item.pagado }}
                    </v-chip>
                </template>
            </v-data-table>
        </v-card>

        <v-dialog v-model="dialog" max-width="900px">
            <v-card>
                <v-card-title>
                    <span> Editar datos Padre/Madre </span>
                </v-card-title>

                <v-card-text class="arabic-text">
                    <v-container>
                        <v-row>
                            <v-col cols="12" md="6">
                                <v-text-field
                                    id="name"
                                    name="name"
                                    placeholder="Nombre"
                                    label="Nombre Padre/Madre"
                                    v-model="editedItem.name"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field
                                    id="apellido"
                                    name="apellido"
                                    placeholder="Apellido"
                                    label="Apellido Padre/Madre"
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
                                    label="اسم الأب"
                                    v-model="editedItem.name_ar"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field
                                    id="apellido_ar"
                                    name="apellido_ar"
                                    placeholder="لقب"
                                    label="لقب الأب"
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
                                    placeholder="address"
                                    label="address"
                                    v-model="editedItem.address"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="3">
                                <v-text-field
                                    id="city"
                                    name="city"
                                    placeholder="city"
                                    label="city"
                                    v-model="editedItem.city"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="3">
                                <v-text-field
                                    id="postalcode"
                                    name="postalcode"
                                    placeholder="postalcode"
                                    label="postalcode"
                                    v-model="editedItem.postalcode"
                                ></v-text-field>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col cols="12" md="6">
                                <v-text-field
                                    id="Matricula"
                                    name="Matricula"
                                    placeholder="Matricula"
                                    label="Matricula"
                                    v-model="editedItem.Matricula"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" md="6">
                                <v-text-field
                                    id="Descuento"
                                    name="Descuento"
                                    placeholder="Descuento"
                                    label="Descuento"
                                    v-model="editedItem.Descuento"
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
    </div>
</template>

<script>
import NavBar from "../NavBar.vue";
export default {
    components: { NavBar },
    name: "padres",
    data() {
        return {
            dialog: false,
            dialogDelete: false,
            search: "",
            data: {
                padres: [],
            },
            editedIndex: -1,
            editedItem: {},
            headers: [
                { text: "Id", value: "id" },
                { text: "Nombre", value: "name" },
                { text: "Apellido", value: "surname" },
                { text: "الإسم", value: "name_ar" },
                { text: "اللقب", value: "surname_ar" },
                { text: "Telefono", value: "telefono" },
                { text: "E-mail", value: "email" },
                { text: "Matricula", value: "Matricula" },
                { text: "Descuento", value: "Descuento" },
                { text: "Pagado", value: "pagado" },
                { text: "Actions", value: "actions", sortable: false },
            ],
        };
    },
    methods: {
        getColor(item) {
            const percent = (item.pagado / item.Matricula) * 100;

            if (percent < 30) return "red";
            else if (percent < 80 && percent >= 30) return "orange";
            else return "green";
        },
        getPadres() {
            axios.get("api/padres").then((response) => {
                this.data.padres = response.data.data.padres;
            });
        },
        handleFunction() {},
        editItem(item) {
            this.editedIndex = this.data.padres.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },
        deleteItem(item) {
            this.editedIndex = this.data.padres.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },
        goToFile(item) {
            this.$router.push("/padre/" + item.id);
        },
        deleteItemConfirm() {
            axios
                .delete("api/padres/" + this.editedItem.id)
                .then((response) => {
                    if (response.status === 200) {
                        this.getPadres();
                    }
                })
                .catch((error) => {
                    console.log("ERROR");
                })
                .finally(() => {
                    //Perform action in always
                });
            this.closeDelete();
        },
        close() {
            this.dialog = false;
        },
        closeDelete() {
            this.dialogDelete = false;
        },
        save() {
            this.submitForm();
            this.close();
        },
        submitForm() {
            axios
                .put("api/padres/" + this.editedItem.id, this.editedItem)
                .then((response) => {
                    if (response.status === 200) {
                        this.getPadres();
                    }
                })
                .catch((error) => {
                    console.log(this.$data);
                })
                .finally(() => {});
        },
    },
    created() {
        this.getPadres();
    },
};
</script>

<style>
@font-face {
    font-family: "arabic-text";
    src: url("../../../../public/fonts/Cocon-Next-Arabic-Light.otf");
}

.arabic-text {
    font-family: "arabic-text";
}
</style>
