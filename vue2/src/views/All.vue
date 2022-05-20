<template>
  <div class="main-container">
    <div class="row">
      <div>
      <v-btn
          elevation="7"
          x-large
          height="80"
          :color="filterFood ? 'grey' : ''"
          @click="filterFoodF"
      >
        <v-img
            :src="require(`../../src/assets/images/food.svg`)"
            width="50"
        ></v-img>
      </v-btn>
      <small>Aliments</small>
      </div>

      <div>
      <v-btn
          elevation="7"
          x-large
          height="80"
          :color="filterMeal ? 'grey' : ''"
          @click="filterMealF"
      >
        <v-img
            :src="require(`../../src/assets/images/meal.svg`)"
            width="50"

        ></v-img>
      </v-btn>
      <small>Repas</small>
    </div>
      <div>
        <v-btn
            elevation="7"
            x-large
            height="80"
            @click="allowCamera"
        >
          <v-icon v-if="!camera">
            mdi-plus
          </v-icon>
          <v-icon v-if="camera">
            mdi-cross
          </v-icon>
        </v-btn>
        <small>Code barre</small>
      </div>
    </div>
    <StreamBarcodeReader v-if="camera" @decode="onDecode" @loaded="onLoaded"></StreamBarcodeReader>

    <v-overlay v-if="product"
        :value="overlay"
         opacity="1"
    >
      <v-form
        ref="form"
        v-model="valid"
      >
        <v-text-field
          label="Nom du produit"
          v-model="product.name"
          :rules="[v => !!v || 'Champ obligatoire']"
        ></v-text-field>
        <v-text-field
          label="Calories"
          v-model="product.calories"
          type="number"
          :rules="[v => !!v || 'Champ obligatoire']"
        ></v-text-field>
        <v-text-field
          label="Glucides"
          v-model="product.carbohydrates"
          type="number"
          :rules="[v => !!v || 'Champ obligatoire']"
        ></v-text-field>
        <v-text-field
          label="Protéines"
          v-model="product.proteins"
          type="number"
          :rules="[v => !!v || 'Champ obligatoire']"
        ></v-text-field>
        <v-text-field
          label="Lipides"
          v-model="product.fat"
          type="number"
          :rules="[v => !!v || 'Champ obligatoire']"
        ></v-text-field>
        <v-select v-model="select"
          :items="getAllCategories"
          :hint="`${select.wording || 'Choisissez la catégorie'}`"
          item-text="wording"
          item-value="id"
          persistent-hint
          return-object
          single-line
          hide-details
          label="Catégorie"
          :rules="this.select.id ? [v => !!v || 'Champ obligatoire'] : []"
        >
        </v-select>
      </v-form>
      <v-btn
          class="white--text"
          color="teal"
          @click="overlay = false"
      >
        Annuler
      </v-btn>
      <v-btn
          class="white--text"
          color="success"
          @click="addNewFood"
          :disabled="valid"
      >
        Ajouter
      </v-btn>
    </v-overlay>

    <v-divider></v-divider>
    <ul>
      <li v-for="(item,i) in aliments" :key="i">
        <span>{{ item.wording }}</span>
        <span>{{ item.calories | formatNumberAfterDecimal }} Kcal
          <v-btn
              v-if="undefined !== item.recipe"
              color="transparent"
              :to="`/cooking/${item.recipe.id}`"
          >
            <v-icon>
            mdi-chef-hat
            </v-icon>
          </v-btn>
        </span>
      </li>
    </ul>
  </div>
</template>

<script>

import MealService from "@/service/meal.service";
import FoodService from "@/service/food.service";
import { StreamBarcodeReader } from "vue-barcode-reader";
import ProductService from "@/service/product.service";
import foodService from "@/service/food.service";

export default {
  name: 'All',
  components: {
    StreamBarcodeReader
  },
  data() {
    return {
      aliments: [],
      filterFood: true,
      filterMeal: true,
      camera: false,
      product: null,
      overlay: false,
      vegan:false,
      select: '',
      valid: false
    }
  },
  computed: {
    getAllCategories() {
      return  this.$store.getters.getAllCategories.map(item => {
        return {
          wording: item.wording,
          id: item.id
        }
      });
    }
  },
  methods: {
    addNewFood(){
      if(this.product && this.select.id){
        foodService.addFood({
          id:null,
          wording: this.product.name,
          calories: this.product.calories,
          carbohydrate: this.product.carbohydrates,
          protein: this.product.proteins,
          fat: this.product.fat,
          saturatedFat: this.product.saturated_fat,
          sugar: this.product.sugars,
          vegan: false,
        }).then(() => {
          this.product = null;
          this.select = '';
          this.valid = false;
          this.getAll();
        }).finally(() => {
          this.overlay = false;
        });
      }
    },
    async onDecode(text) {
      this.product = await ProductService.getProductByEAN(text+".json");
      this.overlay = true;
      this.camera = false;
    },
    onLoaded()
    {
      console.log("loaded");
    },
    async getAllMeals() {
      return await MealService.getAllMeals();
    },
    async getAllFoods() {
      return await FoodService.getAllFoods();
    },
    async getAll() {

      this.aliments = [];

      if(this.filterFood) {
        this.aliments = this.aliments.concat(await this.getAllFoods());
      }
      if(this.filterMeal) {
        this.aliments = this.aliments.concat(await this.getAllMeals());
      }
    },
    async allowCamera() {
      this.camera = !this.camera;
    },
    filterFoodF() {
      this.filterFood = !this.filterFood;
      this.getAll();
    },
    filterMealF() {
      this.filterMeal = !this.filterMeal;
      this.getAll();
    }

  },
  async mounted() {
    await this.$store.dispatch("actionUpdateGetterAllCategories");
    await this.getAll();
  }
}

</script>


<style scoped lang="scss">

ul li{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
ul{
  display: flex;
  flex-direction: column;
  gap: 16px;
  padding: 0;
}

.row{
  position: sticky;
  top: 16px;
  >div{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 33%;
  }
}

.main-container
{
  display: flex;
  flex-direction: column;
  gap: 24px;
}


</style>
