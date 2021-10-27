<template>
    <v-row justify="center">
        <v-dialog
            transition="dialog-bottom-transition"
            v-model="activate"
            max-width="800px"
            persistent
        >
            <v-card>
                <v-card-title class="text-h5">Nuevo profesor</v-card-title>
                <v-container>
                    <v-row>
                        <v-col cols="12" md="6">
                            <v-text-field
                                id="name"
                                name="name"
                                placeholder="Nombre del profesor"
                                v-model="profesor.name"
                                label="Nombre"
                                @input="$v.profesor.name.$touch()"
                                @blur="$v.profesor.name.$touch()"
                                :error-messages="nameErrors"
                                :counter="50"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" md="6">
                            <v-text-field
                                id="apellido"
                                name="apellido"
                                placeholder="Apellido del profesor"
                                v-model="profesor.surname"
                                label="Apellido"
                                @input="$v.profesor.surname.$touch()"
                                @blur="$v.profesor.surname.$touch()"
                                :error-messages="surnameErrors"
                                :counter="50"
                            ></v-text-field>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="12" md="6">
                            <v-text-field
                                id="name"
                                name="name_ar"
                                required
                                autocomplete="name"
                                placeholder="اسم الأب"
                                v-model="profesor.name_ar"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" md="6">
                            <v-text-field
                                id="apellido"
                                name="apellido_ar"
                                required
                                autocomplete="apellido"
                                placeholder="لقب الأب"
                                v-model="profesor.surname_ar"
                            ></v-text-field>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="12" md="4">
                            <v-text-field
                                id="email"
                                type="email"
                                name="email"
                                autocomplete="email"
                                placeholder="Correo"
                                v-model="profesor.email"
                                :error-messages="emailErrors"
                                label="E-mail"
                                @input="$v.profesor.email.$touch()"
                                @blur="$v.profesor.email.$touch()"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-text-field
                                id="DNI"
                                type="text"
                                name="dni"
                                autocomplete="DNI"
                                placeholder="DNI"
                                v-model="profesor.dni"
                                @input="$v.profesor.dni.$touch()"
                                @blur="$v.profesor.dni.$touch()"
                                :error-messages="dniErrors"
                                :counter="16"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" md="4">
                            <v-text-field
                                id="phone"
                                type="text"
                                name="telefono"
                                autocomplete="telefono"
                                placeholder="Teléfono"
                                v-model="profesor.telefono"
                                @input="$v.profesor.telefono.$touch()"
                                @blur="$v.profesor.telefono.$touch()"
                                :error-messages="telefonoErrors"
                                :counter="16"
                            ></v-text-field>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col cols="12" md="6">
                            <v-text-field
                                id="direccion"
                                type="text"
                                name="direccion"
                                required
                                autocomplete="direccion"
                                placeholder="Dirección"
                                v-model="profesor.address"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" md="3">
                            <v-text-field
                                id="city"
                                type="text"
                                name="city"
                                required
                                autocomplete="city"
                                placeholder="Ciudad"
                                v-model="profesor.city"
                            ></v-text-field>
                        </v-col>

                        <v-col cols="12" md="3">
                            <v-text-field
                                id="postalcode"
                                type="text"
                                name="postalcode"
                                required
                                autocomplete="postalcode"
                                placeholder="Código postal"
                                v-model="profesor.postalcode"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>

                <v-card-text>
                    <v-container> </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close"
                        >Cancelar</v-btn
                    >
                    <v-btn color="blue darken-1" text @click="save"
                        >Guardar</v-btn
                    >
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
import { validationMixin } from "vuelidate";
import {
    required,
    maxLength,
    minLength,
    email,
    numeric
} from "vuelidate/lib/validators";
export default {
    mixins: [validationMixin],

    validations: {
        profesor: {
            name: {
                required,
                maxLength: maxLength(50),
                minLength: minLength(2)
            },
            surname: {
                required,
                maxLength: maxLength(50),
                minLength: minLength(2)
            },
            name_ar: { required },
            surname_ar: { required },
            email: {
                required,
                email
            },
            dni: { required },
            telefono: { required, numeric },
            address: { required },
            city: { required },
            postalcode: {}
        }
    },
    components: {},
    props: {
        activate: Boolean
    },
    data() {
        return {
            profesor: {
                id: "",
                name: "",
                surname: "",
                name_ar: "",
                surname_ar: "",
                email: "",
                dni: "",
                telefono: "",
                address: "",
                city: "",
                postalcode: ""
            }
        };
    },
    methods: {
        save() {
            this.submitForm();
        },
        submitForm() {
            console.log(this.profesor);
            axios
                .post("api/profesores/", this.profesor)
                .then(response => {
                    if (response.status === 200) {
                        this.close();
                    }
                })
                .catch(error => {
                    console.log(this.profesor);
                })
                .finally(() => {
                    //Perform action in always
                });
        },
        close() {
            this.$emit("close-form-event", false);
        }
    },

    computed: {
        nameErrors() {
            const errors = [];
            if (!this.$v.profesor.name.$dirty) return errors;

            !this.$v.profesor.name.maxLength && errors.push("Nombre muy largo");
            !this.$v.profesor.name.minLength && errors.push("Nombre muy corto");
            !this.$v.profesor.name.required && errors.push("Required.");

            return errors;
        },
        surnameErrors() {
            const errors = [];
            if (!this.$v.profesor.surname.$dirty) return errors;

            !this.$v.profesor.surname.maxLength &&
                errors.push("Apellido muy largo");
            !this.$v.profesor.surname.required && errors.push("Required");

            return errors;
        },
        emailErrors() {
            const errors = [];
            if (!this.$v.profesor.email.$dirty) return errors;
            !this.$v.profesor.email.email &&
                errors.push("Must be valid e-mail");
            !this.$v.profesor.email.required &&
                errors.push("E-mail is required");
            return errors;
        },
        dniErrors() {
            const errors = [];
            if (!this.$v.profesor.dni.$dirty) return errors;
            !this.$v.profesor.dni.required && errors.push("Required");
            return errors;
        },
        telefonoErrors() {
            const errors = [];
            if (!this.$v.profesor.telefono.$dirty) return errors;

            !this.$v.profesor.telefono.required && errors.push("Required");
            !this.$v.profesor.telefono.numeric && errors.push("No es número");

            return errors;
        }
    }
};
</script>
