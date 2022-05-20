<template>
<div class="center">
  <v-btn to="/login" class="absolute">
    <v-icon color="white">mdi-arrow-left-top</v-icon>
  </v-btn>
  <v-stepper v-model="step" class="stepper">
    <v-stepper-header>
      <v-stepper-step
          :complete="step > 1"
          step="1"
      >
        Name of step 1
      </v-stepper-step>

      <v-divider></v-divider>

      <v-stepper-step
          :complete="step > 2"
          step="2"
      >
        Name of step 2
      </v-stepper-step>

      <v-divider></v-divider>

      <v-stepper-step step="3">
        Name of step 3
      </v-stepper-step>
    </v-stepper-header>

  </v-stepper>
  <v-form
      ref="form"
      v-if="step === 1"
      v-model="validStep1"
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
        :disabled="!validStep1"
        color="indigo darken-3"
        class="mr-4"
        @click="nextStep"
    >
      Suivant
    </v-btn>
    <small>Tous les champs sont obligatoires</small>

  </v-form>
  <v-form
      v-if="step === 2"
      ref="form2"
      v-model="validStep2"
  >
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
            min="1930-01-01"
            max="2008-12-31"
        >
          <v-spacer></v-spacer>
          <v-btn
              text
              color="indigo darken-3"
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
    <small>Tous les champs sont obligatoires</small>

    <div class="button-container">
    <v-btn
        color="indigo darken-3"
        @click="previousStep"
    >Précédent
    </v-btn>
    <v-btn
        :disabled="!validStep2"
        color="indigo darken-3"
        class="mr-4"
        @click="nextStep"
    >
      Suivant
    </v-btn>
    </div>

  </v-form>
  <v-form
      v-if="step === 3"
      ref="form2"
      v-model="validStep3"
  >
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
    <small>Tous les champs sont obligatoires</small>

    <div class="button-container">
    <v-btn
        v-if="step === 3"
        color="indigo darken-3"
        @click="previousStep"
    >Précédent
    </v-btn>
      <v-btn
          :disabled="!validStep3"
          color="indigo darken-3"
          class="mr-4"
          @click="validate"
      >
        Valider
      </v-btn>
    </div>

  </v-form>

  <v-progress-circular
      :size="50"
      color="primary"
      indeterminate
      v-if="loading"
  ></v-progress-circular>

</div>
</template>

<script>
import {mapActions} from "vuex";

export default {
  data () {
    return {
      loading: false,
      step: 1,
      validStep1: false,
      validStep2: false,
      validStep3: false,
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
        {state: 'M', abbr: 'M'},
        {state: 'F', abbr: 'F'},
      ],
      select2: '',
      select3: '',
      formPosition: 0,
      animation: 'animate-in',
    }},
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
      if(this.validStep1 && this.validStep2 && this.validStep3) {
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
          this.loading = true;
          await this.Register(User).then(res => {
            this.$router.push("/");
          }).catch(err => {
            this.error = err
          }).finally(() => {
            this.loading = false;
          })
        } catch (error) {
          this.error = error
        }
      }
    },
    nextStep(){
      this.step++;
    },
    previousStep(){
      this.step--;
    },
  },
}
</script>

<style scoped>

.button-container
{
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 16px;
}
.stepper
{
  position: absolute;
  top: 0;
  transform: translateY(100%);
  width: 95%;
  background: none !important;
}
</style>


