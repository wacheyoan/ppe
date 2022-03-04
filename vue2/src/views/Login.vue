<template>
  <v-form
      ref="form"
      v-model="valid"
      lazy-validation
  >
    <v-text-field
        v-model="email"
        :rules="emailRules"
        label="E-mail"
        required
    ></v-text-field>

    <v-text-field
        v-model="password"
        :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
        :rules="[rules.required, rules.min]"
        :type="show1 ? 'text' : 'password'"
        name="input-10-1"
        label="Normal with hint text"
        hint="At least 8 characters"
        counter
        @click:append="show1 = !show1"
    ></v-text-field>

    <v-btn
        :disabled="!valid"
        color="success"
        class="mr-4"
        @click="validate"
    >
      Validate
    </v-btn>
  </v-form>
</template>

<script>
export default {
  data () {
    return {
      valid: true,
      show1: false,
      password: '',
      rules: {
        required: value => !!value || 'Required.',
        min: v => v.length >= 2 || 'Min 2 characters',
        emailMatch: () => (`The email and password you entered don't match`),
      },
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
    }
  },
  methods: {
    validate () {
      this.$refs.form.validate();
      this.$store.dispatch('login',{
        email:this.email,
        password:this.password
      });
    },
  },
}
</script>