<template>
    <div>
        <nav-bar></nav-bar>
        <v-card class="mx-auto mt-5" width="90%">
            <v-card-title>
                Alumnos
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
                :items="alumnos"
                item-key="id"
                class="arabic-text"
                :search="search"
                :items-per-page="30"
            >
                <template v-slot:item.actions="{ item }">
                    <v-icon small class="mr-2" @click="editItem(item)">
                        mdi-pencil
                    </v-icon>

                    <v-icon small @click="deleteItem(item)">
                        mdi-delete
                    </v-icon>
                </template>

                <template v-slot:item.nivel="{ item }">
                    <span v-if="item.nivel == 0"> {{ "INFANTIL" }}</span>
                    <span v-else> {{ item.nivel }}</span>
                </template>
            </v-data-table>
        </v-card>

        <v-dialog v-model="dialog" max-width="800px">
            <v-card>
                <v-card-title>
                    <span class="text-h5"> Editar datos del Alumno/a</span>
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
                            <v-col cols="12" md="8">
                                <v-select
                                    id="grupos_id"
                                    name="grupos_id"
                                    placeholder="Grupo"
                                    label="Grupo"
                                    v-model="editedItem.grupos_id"
                                    :items="grupos"
                                    item-text="id"
                                >
                                    <template
                                        slot="selection"
                                        slot-scope="data"
                                    >
                                        <span v-if="data.item.nivel == 0">
                                            {{ "INFANTIL" }}</span
                                        >
                                        <span v-else>
                                            {{ data.item.nivel + "º " }}</span
                                        >
                                        {{
                                            "  - " +
                                            data.item.dia +
                                            " - " +
                                            data.item.horario +
                                             " - " +
                                            data.item.name + " " + data.item.surname
                                        }}
                                    </template>

                                    <template v-slot:item="{ item }">
                                        <span v-if="item.nivel == 0">
                                            {{ "INFANTIL" }}</span
                                        >
                                        <span v-else>
                                            {{ item.nivel + "º " }}</span
                                        >
                                        {{
                                            " - " +
                                            item.dia +
                                            " - " +
                                            item.horario +
                                            " - " +
                                            item.name + " " + item.surname
                                        }}
                                    </template>
                                </v-select>
                            </v-col>

                            <v-col cols="12" sm="6" md="4">
                                <v-menu
                                    ref="menu"
                                    v-model="menu"
                                    :close-on-content-click="false"
                                    :return-value.sync="editedItem.birthday"
                                    transition="scale-transition"
                                    offset-y
                                    min-width="auto"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            v-model="editedItem.birthday"
                                            label="Fecha de nacimiento"
                                            prepend-icon="mdi-calendar"
                                            v-bind="attrs"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        v-model="editedItem.birthday"
                                        no-title
                                        scrollable
                                    >
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            text
                                            color="primary"
                                            @click="menu = false"
                                        >
                                            Cancel
                                        </v-btn>
                                        <v-btn
                                            text
                                            color="primary"
                                            @click="
                                                $refs.menu.save(
                                                    editedItem.birthday
                                                )
                                            "
                                        >
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-menu>
                            </v-col>
                            <v-spacer></v-spacer>
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
    </div>
</template>

<script>
import NavBar from "../NavBar.vue";
export default {
    components: { NavBar },
    name: "alumnos",
    data() {
        return {
            date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
                .toISOString()
                .substr(0, 10),
            menu: false,
            modal: false,
            menu2: false,
            editedIndex: -1,
            editedItem: {},
            dialog: false,
            search: "",
            alumnos: [],
            grupos: [],
            headers: [
                { text: "Id", value: "id" },
                { text: "Nombre", value: "name" },
                { text: "Apellido", value: "surname" },
                { text: "الإسم", value: "surname_ar" },
                { text: "اللقب", value: "name_ar" },
                { text: "Fecha de Nacimiento", value: "birthday" },
                { text: "Nivel", value: "nivel" },
                { text: "Dia", value: "dia" },
                { text: "Horario", value: "horario" },
                { text: "Actions", value: "actions", sortable: false },
            ],
        };
    },
    methods: {
        getAlumnos() {
            axios.get("api/alumnos").then((response) => {
                this.alumnos = response.data.data;
            });
        },
        getGrupos() {
            axios.get("api/grupos").then((response) => {
                this.grupos = response.data.data;
            });
        },
        editItem(item) {
            this.editedIndex = this.alumnos.indexOf(item);
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
                .put("api/alumnos/" + this.editedItem.id, this.editedItem)
                .then((response) => {
                    if (response.status === 200) {
                        this.getAlumnos();
                    }
                })
                .catch((error) => {
                    console.log(this.$data);
                })
                .finally(() => {});
        },
        formatDate(date) {
            if (!date) return null;

            const [year, month, day] = date.split("-");
            return `${month}/${day}/${year}`;
        },
        parseDate(date) {
            if (!date) return null;

            const [month, day, year] = date.split("/");
            return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
        },
    },
    created() {
        this.getAlumnos();
        this.getGrupos();
    },
    computed: {
        computedDateFormatted() {
            return this.formatDate(this.date);
        },
    },
};
</script>

<style></style>
