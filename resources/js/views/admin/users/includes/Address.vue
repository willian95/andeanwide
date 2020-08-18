<template>
    <div>
        <h6 class="heading-small text-muted mb-4">Datos Residencia</h6>
        <div class="pl-lg-4">
            <div v-if="!user.address" class="row">
                <div class="col">
                    <p>Información de residencia no ha sido cargada.</p>
                </div>
            </div>
            <div v-else>
                <div v-if="user.address.verified_at" class="row">
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
                            :value="user.address.country.name"
                            name="address_country_name"
                            type="text"
                            label="País de residencia"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <InputComponent
                            :value="user.address.state"
                            name="state"
                            type="text"
                            label="Estado/Región/Provincia"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <InputComponent
                            :value="user.address.city"
                            name="city"
                            type="text"
                            label="Ciudad"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-sm-6">
                        <InputComponent
                            :value="user.address.cod"
                            name="cod"
                            type="text"
                            label="Código postal"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12">
                        <InputComponent
                            :value="user.address.address"
                            name="address"
                            type="text"
                            label="Dirección"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12">
                        <InputComponent
                            :value="user.address.address_ext"
                            name="address_ext"
                            type="text"
                            label="Dirección (Continuación)"
                            :disabled="true"
                        />
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div v-if="user.address.image_url" class="col-12 col-md-6">
                        <image-card
                            :imageUrl="user.address.image_url"
                            imageTitle="Prueba de residencia"
                            imageName="document_address"
                        >
                            <ul class="list-unstyled my-4 px-4 pt-3">
                                <li>
                                    <strong>País de residencia:</strong>
                                    {{ user.address.country.name }}
                                </li>
                                <li>
                                    <strong>Estado/Región/Provincia:</strong>
                                    {{ user.address.state }} |
                                    <span>
                                        <strong>Ciudad:</strong>
                                        {{ user.address.city }}
                                    </span>
                                </li>
                                <li>
                                    <strong>Código postal:</strong>
                                    {{ user.address.cod }}
                                </li>
                                <li>
                                    <strong>Dirección:</strong>
                                    {{ user.address.address }}
                                </li>
                                <li>
                                    {{ user.address.address_ext }}
                                </li>
                            </ul>
                        </image-card>
                    </div>
                </div>
                <div v-if="!user.address.verified_at" class="row mt-5">
                    <check-component
                        v-model="addressConfirmation"
                        label="Confirmación de revisión de datos de prueba de residencia"
                        name="address-confirmation"
                    />
                </div>
                <user-document-eval
                    v-if="addressConfirmation"
                    :userId="user.id"
                    :acceptRoute="validateAddressRoute"
                    :rejectRoute="unvalidateAddressRoute"
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
    name: 'UserAddressInclude',
    components: {
        InputComponent,
        ImageCard,
        CheckComponent,
        UserDocumentEval
    },
    props: {
        user: {
            type: Object,
            detault: () => {}
        },
        validateAddressRoute: {
            type: String,
            default: () => {}
        },
        unvalidateAddressRoute: {
            type: String,
            default: () => {}
        },
        csrf: {
            type: String,
            default: ''
        }
    },
    data: () => ({
        addressConfirmation: false,
    })
}
</script>
