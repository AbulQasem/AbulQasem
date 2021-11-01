<template>
    <v-container class="formulario arabic-text">
        <v-form v-on:submit.prevent="submitForm">
            <v-container>
                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field
                            id="name"
                            name="name"
                            placeholder="Nombre del padre/madre"
                            v-model="padre.name"
                            label="Nombre"
                            @input="$v.padre.name.$touch()"
                            @blur="$v.padre.name.$touch()"
                            :error-messages="nameErrors"
                            :counter="50"
                        ></v-text-field>
                    </v-col>

                    <v-col cols="12" md="6">
                        <v-text-field
                            id="apellido"
                            name="apellido"
                            placeholder="Apellido del padre/madre"
                            v-model="padre.surname"
                            label="Apellido"
                            @input="$v.padre.surname.$touch()"
                            @blur="$v.padre.surname.$touch()"
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
                            v-model="padre.name_ar"
                        ></v-text-field>
                    </v-col>

                    <v-col cols="12" md="6">
                        <v-text-field
                            id="apellido"
                            name="apellido_ar"
                            required
                            autocomplete="apellido"
                            placeholder="لقب الأب"
                            v-model="padre.surname_ar"
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
                            v-model="padre.email"
                            :error-messages="emailErrors"
                            label="E-mail"
                            @input="$v.padre.email.$touch()"
                            @blur="$v.padre.email.$touch()"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-text-field
                            id="DNI"
                            type="text"
                            name="dni"
                            autocomplete="DNI"
                            placeholder="DNI"
                            v-model="padre.dni"
                            @input="$v.padre.dni.$touch()"
                            @blur="$v.padre.dni.$touch()"
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
                            v-model="padre.telefono"
                            @input="$v.padre.telefono.$touch()"
                            @blur="$v.padre.telefono.$touch()"
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
                            v-model="padre.address"
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
                            v-model="padre.city"
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
                            v-model="padre.postalcode"
                        ></v-text-field>
                    </v-col>
                </v-row>
            </v-container>

            <v-container>
                <v-card>
                    <v-card-title>
                        {{ "Datos del hijo/a" }}
                    </v-card-title>

                    <v-card-text class="arabic-text"> 
                        <table class="form-group" id="dynamic_field">
                            <div class="row">
                                <div class="col-2">Nombre</div>
                                <div class="col-2">Apellido</div>
                                <div class="col-2">الإسم</div>
                                <div class="col-2">اللقب</div>
                                <div class="col-3">Fecha Nacimiento</div>
                                <div class="col-1">
                                    <a
                                        type="button"
                                        name="add"
                                        id="add"
                                        class="btn btn-info float-right"
                                        @click="addRow()"
                                        >+</a
                                    >
                                </div>
                            </div>
                            <tbody id="dinamic-form">
                                <tr
                                    class="row"
                                    id="dinamic-row"
                                    v-for="(hijo, index) in alumnos"
                                    :key="index"
                                >
                                    <td class="col-2">
                                        <input
                                            class="form-control"
                                            type="text"
                                            v-model="alumnos[index].name"
                                        />
                                    </td>
                                    <td class="col-2">
                                        <input
                                            class="form-control"
                                            type="text"
                                            v-model="alumnos[index].surname"
                                        />
                                    </td>
                                    <td class="col-2">
                                        <input
                                            class="form-control"
                                            type="text"
                                            v-model="alumnos[index].name_ar"
                                        />
                                    </td>
                                    <td class="col-2">
                                        <input
                                            class="form-control"
                                            type="text"
                                            v-model="alumnos[index].surname_ar"
                                        />
                                    </td>
                                    <td class="col-3">
                                        <input
                                            class="form-control"
                                            type="date"
                                            v-model="alumnos[index].birthday"
                                        />
                                    </td>
                                    <td class="col-1">
                                        <a
                                            href="#"
                                            class="btn btn-danger remove float-right"
                                            @click="deleteRow(index)"
                                            v-if="index != 0"
                                            >-</a
                                        >
                                    </td>
                                </tr>
                            </tbody>
                            <div
                                v-for="(v, index) in $v.alumnos.$each.$iter"
                                :key="index"
                            >
                                <div class="error" v-if="!v.name.required">
                                    Name is required.
                                </div>
                            </div>
                        </table>
                    </v-card-text>
                </v-card>
            </v-container>

            <v-container>
                <v-spacer></v-spacer>
                <v-btn
                    color="success"
                    x-large
                    dark
                    type="submit"
                    @click.prevent="submitForm"
                >
                    Guardar
                </v-btn>
            </v-container>
        </v-form>
    </v-container>
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
        padre: {
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
        },
        alumnos: {
            required,
            $each: {
                name: {
                    required
                }
            }
        }
    },
    name: "form",
    components: {},
    data() {
        return {
            invalid: true,
            email: "",
            padre: {
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
            },
            alumnos: [
                {
                    name: "",
                    surname: "",
                    name_ar: "",
                    surname_ar: "",
                    birthday: ""
                }
            ]
        };
    },
    methods: {
        addRow() {
            this.alumnos.push({
                name: "",
                surname: "",
                name_ar: "",
                surname_ar: "",
                birthday: ""
            });
        },
        deleteRow(index) {
            this.alumnos.splice(index, 1);
        },
        submitForm() {
            this.$v.$touch();

            if (this.$v.$invalid) {
                this.$v.$touch();
            } else {
                axios
                    .post("api/matricula", this.$data)
                    .then(response => {
                        if (response.status === 200) {
                            this.$router.push({ path: "/" });
                        }
                    })
                    .catch(error => {
                        console.log(this.$data);
                    })
                    .finally(() => {
                        //Perform action in always
                    });
            }
        },
        clear() {
            this.$v.$reset();
        }
    },
    computed: {
        nameErrors() {
            const errors = [];
            if (!this.$v.padre.name.$dirty) return errors;

            !this.$v.padre.name.maxLength && errors.push("Nombre muy largo");
            !this.$v.padre.name.minLength && errors.push("Nombre muy corto");
            !this.$v.padre.name.required && errors.push("Required.");

            return errors;
        },
        surnameErrors() {
            const errors = [];
            if (!this.$v.padre.surname.$dirty) return errors;

            !this.$v.padre.surname.maxLength &&
                errors.push("Apellido muy largo");
            !this.$v.padre.surname.required && errors.push("Required");

            return errors;
        },
        emailErrors() {
            const errors = [];
            if (!this.$v.padre.email.$dirty) return errors;
            !this.$v.padre.email.email && errors.push("Must be valid e-mail");
            !this.$v.padre.email.required && errors.push("E-mail is required");
            return errors;
        },
        dniErrors() {
            const errors = [];
            if (!this.$v.padre.dni.$dirty) return errors;
            !this.$v.padre.dni.required && errors.push("Required");
            return errors;
        },
        telefonoErrors() {
            const errors = [];
            if (!this.$v.padre.telefono.$dirty) return errors;

            !this.$v.padre.telefono.required && errors.push("Required");
            !this.$v.padre.telefono.numeric && errors.push("No es número");

            return errors;
        }
    }
};
</script>

<style></style>
