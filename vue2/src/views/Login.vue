<template>
<div class="center">
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
        label="Mot de passe"
        counter
        @click:append="show1 = !show1"
    ></v-text-field>

    <v-btn
        :disabled="!valid"
        color="indigo darken-3"
        class="mr-4"
        @click="validate"
    >
      Se connecter
    </v-btn>
    <router-link to="/register">Pas encore inscrit ?</router-link>
  </v-form>
  </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
  data () {
    return {
      valid: false,
      show1: false,
      password: '',
      error: '',
      rules: {
        required: value => !!value || 'Requis.',
        min: v => v.length >= 2 || 'Min 2 characters',
        emailMatch: () => (`L'email et le mot de passe ne correspondent pas.`)
      },
      email: '',
      emailRules: [
        v => !!v || 'E-mail est obligatoire',
        v => /.+@.+\..+/.test(v) || 'E-mail   doit être valide',
      ],
    }
  },
  methods: {
    ...mapActions(["LogIn"]),
    async validate() {
      if(this.$refs.form.validate()) {
        const User = new FormData();
        User.append("username", this.email);
        User.append("password", this.password);
        try {
          await this.LogIn(User).then(res => {
            this.$router.push("/");
          }).catch(err => {
            this.error = err
          });
        } catch (error) {
          this.error = error
        }
      }
    },
  },
}
</script>
