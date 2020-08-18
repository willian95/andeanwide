<template>
    <div>
        <h6 class="heading-small text-muted mb-4">Datos Identificación</h6>
        <div class="pl-lg-4">
            <div v-if="!user.identity" class="row">
                <div class="col">
                    <p>Información de identidad no ha sido cargada.</p>
                </div>
            </div>
            <div v-else>
                <div v-if="user.identity.verified_at" class="row">
                    <div class="col-12">
                        <p class="text-success font-weight-bold">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            Información de identidad ha sido confirmada.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <InputComponent
                            :value="user.identity.country.name"
                            name="identity_country_name"
                            type="text"
                            label="País emisor del documento"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <InputComponent
                            :value="user.identity.nationality"
                            name="nationality"
                            type="text"
                            label="Nacionalidad"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <InputComponent
                            :value="user.identity.document_type"
                            name="document_type"
                            type="text"
                            label="Tipo de documento"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <InputComponent
                            :value="user.identity.gender"
                            name="gender"
                            type="text"
                            label="Género"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <InputComponent
                            :value="user.identity.dni_number"
                            name="dni_number"
                            type="text"
                            label="Número de documento"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <InputComponent
                            :value="user.identity.validation_number"
                            name="validation_number"
                            type="text"
                            label="Número de validación"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-4">
                        <InputComponent
                            :value="user.identity.issue_date"
                            name="issue_date"
                            type="text"
                            label="Fecha de emisión del documento"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-4">
                        <InputComponent
                            :value="user.identity.expiration_date"
                            name="expiration_date"
                            type="text"
                            label="Fecha de expiración del documento"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-4">
                        <InputComponent
                            :value="user.identity.dob"
                            name="dob"
                            type="text"
                            label="Fecha de nacimiento"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <InputComponent
                            :value="user.identity.first_name"
                            name="first_name"
                            type="text"
                            label="Primer nombre"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <InputComponent
                            :value="user.identity.middle_name"
                            name="middle_name"
                            type="text"
                            label="Segundo nombre"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <InputComponent
                            :value="user.identity.last_name"
                            name="last_name"
                            type="text"
                            label="Primer apellido"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <InputComponent
                            :value="user.identity.second_surname"
                            name="second_surname"
                            type="text"
                            label="Segundo apellido"
                            :disabled="true"
                        />
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div v-if="user.identity.front_image_url" class="col-12 col-md-6">
                        <image-card
                            :imageUrl="user.identity.front_image_url"
                            imageTitle="Documento de Identidad"
                            imageName="document_identity_front"
                        >
                            <ul class="list-unstyled my-4 px-4 pt-3">
                                <li>
                                    <strong>Nombre:</strong>
                                    {{ user.identity.first_name }} {{ user.identity.middle_name }} {{ user.identity.last_name }} {{ user.identity.second_surname }}
                                </li>
                                <li>
                                    <strong>Nacionalidad:</strong>
                                    {{ user.identity.nationality }} |
                                <span>
                                    <strong>Fecha de nacimiento:</strong>
                                    {{ user.identity.dob }}
                                </span>
                                </li>
                                <li>
                                    <strong>País emisor del documento:</strong>
                                    {{ user.identity.country.name }} |
                                <span>
                                    <strong>Tipo de documento:</strong>
                                    {{ user.identity.document_type }}
                                </span>
                                </li>
                                <li>
                                    <strong>Numero de documento:</strong>
                                    {{ user.identity.dni_number }} |
                                <span v-if="user.identity.validation_number">
                                    <strong>Numero de validación:</strong>
                                    {{ user.identity.validation_number }}
                                </span>
                                </li>
                                <li>
                                    <strong>Fecha de emisión:</strong>
                                    {{ user.identity.issue_date }} |
                                <span>
                                    <strong>Fecha de expiración:</strong>
                                    {{ user.identity.expiration_date }}
                                </span>
                                </li>
                            </ul>
                        </image-card>
                    </div>
                    <div v-if="user.identity.reverse_image_url" class="col-12 col-md-6">
                        <image-card
                            :imageUrl="user.identity.reverse_image_url"
                            imageTitle="Documento de Identidad - Reverso"
                            imageName="document_identity_back"
                        >
                            <ul class="list-unstyled my-4 px-4 pt-3">
                                <li>
                                    <strong>Nombre:</strong>
                                    {{ user.identity.first_name }} {{ user.identity.middle_name }} {{ user.identity.last_name }} {{ user.identity.second_surname }}
                                </li>
                                <li>
                                    <strong>Nacionalidad:</strong>
                                    {{ user.identity.nationality }} |
                                    <span>
                                        <strong>Fecha de nacimiento:</strong>
                                        {{ user.identity.dob }}
                                    </span>
                                </li>
                                <li>
                                    <strong>País emisor del documento:</strong>
                                    {{ user.identity.country.name }} |
                                    <span>
                                        <strong>Tipo de documento:</strong>
                                        {{ user.identity.document_type }}
                                    </span>
                                </li>
                                <li>
                                    <strong>Numero de documento:</strong>
                                    {{ user.identity.dni_number }} |
                                    <span v-if="user.identity.validation_number">
                                        <strong>Numero de validación:</strong>
                                        {{ user.identity.validation_number }}
                                    </span>
                                </li>
                                <li>
                                    <strong>Fecha de emisión:</strong>
                                    {{ user.identity.issue_date }} |
                                    <span>
                                        <strong>Fecha de expiración:</strong>
                                        {{ user.identity.expiration_date }}
                                    </span>
                                </li>
                            </ul>
                        </image-card>
                    </div>
                </div>
                <div v-if="!user.identity.verified_at" class="row mt-5">
                    <check-component
                        v-model="identityConfirmation"
                        label="Confirmación de revisión de datos de identidad"
                        name="identity-confirmation"
                    />
                </div>
                <user-document-eval
                    v-if="identityConfirmation"
                    :userId="user.id"
                    :acceptRoute="validateIdentityRoute"
                    :rejectRoute="unvalidateIdentityRoute"
                    :csrf="csrf"
                />
            </div>
        </div>
    </div>
</template>

<script>
import InputComponent from '../../../../components/InputComponent'
import ImageCard from '../../../../components/ImageCard'
import CheckComponent from '../../../../components/CheckComponent'
import UserDocumentEval from '../../../../components/UserDocumentEval'

export default {
    name: 'UserIdentityInclude',
    components: {
        InputComponent,
        ImageCard,
        CheckComponent,
        UserDocumentEval
    },
    props: {
        user: {
            type: Object,
            default: () => {}
        },
        validateIdentityRoute: {
            type: String,
            default: () => {}
        },
        unvalidateIdentityRoute: {
            type: String,
            default: () => {}
        },
        csrf: {
            type: String,
            default: ''
        }
    },
    data: () => ({
        identityConfirmation: false
    })
}
</script>