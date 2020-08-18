<template>
  <div>
    <h6 class="heading-small text-muted mb-4">Datos</h6>

    <div class="pl-lg-4">
      <div class="row">
        <div class="col-6">
            <InputComponent
                :value="user.name"
                name="name"
                type="text"
                label="Nombre"
                :disabled="true"
            />
        </div>
        <div class="col-6">
            <InputComponent
                :value="user.lastname"
                name="lastname"
                type="text"
                label="Apellido"
                :disabled="true"
            />
        </div>
        <div class="col-6">
            <InputComponent
                :value="user.country.name"
                name="user_country_name"
                type="text"
                label="Pais de Residencia"
                :disabled="true"
            />
        </div>
        <div class="col-6">
            <InputComponent
                :value="user.identification"
                name="identification"
                type="text"
                label="Identificación"
                :disabled="true"
            />
        </div>
        <div class="col-6">
            <InputComponent
                :value="user.email"
                name="email"
                type="text"
                label="Correo Electrónico"
                :disabled="true"
            />
        </div>
        <div class="col-6">
            <InputComponent
                :value="user.phone"
                name="phone"
                type="text"
                label="Teléfono"
                :disabled="true"
            />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import InputComponent from '../../../../components/InputComponent'

export default {
  name: "UserInclude",
  components: {
      InputComponent
  },
  props: {
    user: {
      type: Object,
      default: () => {}
    }
  }
};
</script>