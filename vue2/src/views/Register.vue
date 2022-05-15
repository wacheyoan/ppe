<template>
  <v-form
      ref="form"
      lazy-validation
      v-model="valid"
  >
    <v-text-field
        v-model="email"
        :rules="emailRules"
        label="E-mail"
        required
    ></v-text-field>
      <v-text-field
          label="Votre nom"
          v-model="lastName"
          :rules="[v => !!v || 'Veuillez entrer votre nom']"
      ></v-text-field>
      <v-text-field
          label="Votre prénom"
          v-model="firstName"
          :rules="[v => !!v || 'Veuillez entrer votre prénom']"
      ></v-text-field>
      <v-dialog
          ref="dialog"
          :return-value.sync="date"
          persistent
          width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
              v-model="date"
              label="Votre date de naissance"
              append-icon="mdi-calendar"
              readonly
              v-bind="attrs"
              v-on="on"
              :rules="[v => !!v || 'Veuillez entrer votre date de naissance']"
          ></v-text-field>
        </template>
        <v-date-picker
            v-model="date"
            scrollable
            locale="fr-FR"
        >
          <v-spacer></v-spacer>
          <v-btn
              text
              color="primary"
              @click="modal = false"
          >
            Annuler
          </v-btn>
          <v-btn
              text
              color="primary"
              @click="$refs.dialog.save(date)"
          >
            OK
          </v-btn>
        </v-date-picker>
      </v-dialog>
      <v-select
          v-model="select"
          :hint="`${select.state || 'Choisissez votre sexe'}, ${select.abbr || ''}`"
          :items="items"
          item-text="state"
          item-value="abbr"
          label="Sexe"
          persistent-hint
          return-object
          single-line
          :rules="[v => !!v || 'Veuillez sélectionner votre sexe']"
      ></v-select>

    <v-text-field
        v-model="weight"
        :rules="[v => !!v || 'Veuillez entrer votre poids']"
        label="Votre poids"
        type="number"
        required
    ></v-text-field>

    <v-text-field
        v-model="height"
        label="Votre taille"
        :rules="[v => !!v || 'Veuillez entrer votre taille']"
        type="number"
        required
    ></v-text-field>
    <v-select
          v-model="select2"
          :hint="`${select2.activity || 'Choisissez votre niveau d\'activité'}`"
          :items="getAllActivities"
          item-text="activity"
          item-value="id"
          label="Niveau d'activité"
          persistent-hint
          return-object
          single-line
          :rules="[v => !!v || 'Veuillez entrer votre niveau d\'activité']"
      ></v-select>
    <v-select
        v-model="select3"
        :hint="`${select2.objective || 'Choisissez votre objectif'}`"
        :items="getAllObjectives"
        item-text="objective"
        item-value="id"
        label="Objectif"
        persistent-hint
        return-object
        single-line
        :rules="[v => !!v || 'Veuillez entrer votre niveau d\'activité']"
    ></v-select>
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
    <v-text-field
        v-model="repeatPassword"
        :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
        :rules="[rules.required, rules.min, (this.password === this.repeatPassword) || 'Password must match']"
        :type="show2 ? 'text' : 'password'"
        name="input-10-1"
        label="Répétez le mot de passe"
        counter
        @click:append="show2 = !show2"
    ></v-text-field>
      <v-btn
          :disabled="!valid"
          color="success"
          class="mr-4"
          @click="validate"
      >
        Valider
      </v-btn>
    <router-link to="/login">Déjà un compte ?</router-link>

  </v-form>
</template>

<script>
import {mapActions} from "vuex";

export default {
  data () {
    return {
      valid: false,
      weight: '',
      height: '',
      firstName: '',
      lastName: '',
      date: '',
      select: '',
      password: '',
      repeatPassword: '',
      show1: false,
      show2: false,
      email: '',
      emailRules: [
        v => !!v || 'E-mail est obligatoire',
        v => /.+@.+\..+/.test(v) || 'E-mail   doit être valide',
      ],
      rules: {
        required: value => !!value || 'Requis.',
        min: v => v.length >= 2 || 'Min 2 characters',
        emailMatch: () => (`L'email et le mot de passe ne correspondent pas.`)
      },
      items: [
        { state: 'M', abbr: 'M' },
        { state: 'F', abbr: 'F' },
      ],
      select2: '',
      select3: '',
    }
  },
  async mounted() {
    await this.$store.dispatch("actionUpdateGetterAllActivities");
    await this.$store.dispatch("actionUpdateGetterAllObjectives");
  },
  computed: {
    getAllActivities() {
      return this.$store.getters.getAllActivities.map(item => {
        return {
          activity: item.wording,
          id: item.id
        }
      })
    },
    getAllObjectives() {
      return this.$store.getters.getAllObjectives.map(item => {
        return {
          objective: item.wording,
          id: item.id
        }
      })
    },
  },
  methods: {
    ...mapActions(["Register"]),
    async validate() {
      if(this.$refs.form.validate()){
        const User = new FormData();
        User.append("username", this.email);
        User.append("password", this.password);
        User.append("firstName", this.firstName);
        User.append("lastName", this.lastName);
        User.append("date", this.date);
        User.append("sexe", this.select.state);
        User.append("activity", this.select2.activity);
        User.append("objective", this.select3.objective);
        User.append("weight", this.weight);
        User.append("height", this.height);


        try {
          await this.Register(User).then(res => {
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

<style scoped>
form{
  width: 100%;

}
</style>
