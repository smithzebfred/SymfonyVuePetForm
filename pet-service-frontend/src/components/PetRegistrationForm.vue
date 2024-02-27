<template>
  <div class="text-start pet-registration container my-5 card">
    <img src="../assets/paws.png" class="mb-3" />

    <div v-if="showAlert" :class="['alert', alertClass]" role="alert">
      {{ alertMessage }}
    </div>
    <h4 class="mb-4 text-default">Tell us about your pet</h4>
    <form @submit.prevent="registerPet">
      <div class="mb-3">
        <label for="petName" class="form-label">What is your pet's name?</label>
        <input
          type="text"
          class="form-control"
          id="petName"
          v-model="pet.name"
          placeholder="Name"
          required
        />
      </div>

      <div class="m-3">
        <div><strong>Choose One</strong></div>
        <div class="form-check">
          <input
            class="form-check-input"
            type="radio"
            name="type"
            id="cat"
            value="cat"
            v-model="pet.type"
          />
          <label class="form-check-label" for="cat">Cat</label>
        </div>
        <div class="form-check">
          <input
            class="form-check-input"
            type="radio"
            name="type"
            id="dog"
            value="dog"
            v-model="pet.type"
            @change="togglePetType"
          />
          <label class="form-check-label" for="dog">Dog</label>
        </div>
      </div>
      <div class="mb-3">
        <label for="breed" class="form-label">What breed are they?</label>
        <input
          type="dropdown"
          class="form-control"
          id="breed"
          v-model="pet.breed"
          list="breeds"
          placeholder="Select a breed"
          required
        />
        <datalist id="breeds">
          <option v-for="breed in breads" :key="breed" :value="breed">
            {{ breed }}
          </option>
        </datalist>
      </div>

      <div v-show="unknownBreed" class="m-3">
        <div><strong>Choose One</strong></div>
        <div class="form-check">
          <input
            class="form-check-input"
            type="radio"
            name="breedChoice"
            id="unknown"
            value="unknown"
            v-model="pet.breedChoice"
          />
          <label class="form-check-label" for="unknown">I don't know</label>
        </div>
        <div class="form-check">
          <input
            class="form-check-input"
            type="radio"
            name="breedChoice"
            id="mix"
            value="mix"
            v-model="pet.breedChoice"
            @change="toggleBreedInput"
          />
          <label class="form-check-label" for="mix">It's a mix</label>
        </div>
      </div>

      <!-- Selected breeds display -->
      <div v-show="unknownBreed && mixBreed" class="mb-3">
        <label for="selectedBreeds" class="form-label">Selected breeds</label>
        <input
          type="text"
          class="form-control"
          id="selectedBreeds"
          placeholder="Breed1,Breed2...."
          v-model="pet.breeds"
        />
      </div>

      <!-- Gender buttons -->
      <div class="mb-4">
        <label class="form-label d-block">What gender are they?</label>
        <div class="btn-group" role="group" aria-label="Gender selection">
          <input
            type="button"
            class="btn default-color"
            :class="{
              'btn-outline-primary': pet.gender !== 'female',
              'btn-primary': pet.gender === 'female',
            }"
            @click="setGender('female')"
            value="Female"
          />
          <input
            type="button"
            class="btn default-color"
            :class="{
              'btn-outline-primary': pet.gender !== 'male',
              'btn-primary': pet.gender === 'male',
            }"
            @click="setGender('male')"
            value="Male"
          />
        </div>
      </div>

      <!-- Submission button -->
      <div class="d-grid">
        <button
          type="submit"
          :disabled="isButtonDisabled"
          class="btn btn-primary"
        >
          Save
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      showAlert: false,
      alertMessage: "",
      alertType: "",
      isButtonDisabled: false,
      pet: {
        name: "",
        type: "",
        breed: "",
        breedChoice: "",
        gender: "",
        breeds: [],
        showBreedInput: false,
      },
      catBreeds: [
        "Persian",
        "Maine Coon",
        "Siamese",
        "Ragdoll",
        "Bengal",
        "British Shorthair",
        "Sphynx",
        "Scottish Fold",
        "Birman",
        "Abyssinian",
        "Russian Blue",
        "Norwegian Forest Cat",
        "Oriental Shorthair",
        "American Shorthair",
        "Himalayan",
        "Can't find it?",
      ],
      dogBreeds: [
        "Labrador Retriever",
        "German Shepherd",
        "Golden Retriever",
        "French Bulldog",
        "Bulldog",
        "Beagle",
        "Poodle",
        "Rottweiler",
        "Yorkshire Terrier",
        "Boxer",
        "Dachshund",
        "Siberian Husky",
        "Doberman Pinscher",
        "Great Dane",
        "Cavalier King Charles Spaniel",
        "Shih Tzu",
        "Boston Terrier",
        "Pomeranian",
        "Havanese",
        "Shetland Sheepdog",
        "Border Collie",
        "Australian Shepherd",
        "Cocker Spaniel",
        "Chihuahua",
        "Pembroke Welsh Corgi",
        "Can't find it?",
      ],
    };
  },
  computed: {
    breads() {
      return this.pet.type === "dog" ? this.dogBreeds : this.catBreeds;
    },
    unknownBreed() {
      return this.pet.breed === "Can't find it?";
    },
    mixBreed() {
      return this.pet.breedChoice === "mix";
    },
    alertClass() {
      return this.alertType === "error" ? "alert-danger" : "alert-success";
    },
  },
  methods: {
   async registerPet() {
  this.isButtonDisabled = true;
  try {
    const breedData = this.mixBreed ? this.getProcessedBreeds() : this.pet.breed;

    const postData = {
      Name: this.pet.name,
      Breed: breedData,
      Type: this.pet.type === "dog" ? 1 : 0,
      Gender: this.pet.gender === "male" ? 1 : 0,
 
    };
  console.log(postData);
    const response = await fetch('https://localhost:8000/pet', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(postData),
    });

    if (!response.ok) {
      throw new Error('Request failed');
    }

    const data = await response.json();
    console.log(data);
    this.setAlert(`Success: ${data.status}`, true, "success");
  } catch (error) {
    console.error(error);
    this.isButtonDisabled = false;
    this.setAlert(`Error: ${error.response?.data?.message || error.message}`, true, "error");
  }
},

    getProcessedBreeds() {
      return this.pet.breeds
        .split(",")
        .map((breed) => breed.trim())
        .join(",");
    },

    setAlert(message, isVisible, type) {
      this.alertMessage = message;
      this.showAlert = isVisible;
      this.alertType = type; // set the alert type
    },
    selectBreed(val) {
      this.breads.push(val);
    },
    setGender(gender) {
      this.pet.gender = gender;
    },
  },
};
</script>

<style scoped>
.container {
  box-shadow: #090909;
  padding: 10px 40px 40px 40px;
  width: 30%;
  background-color: white;
}

@media (max-width: 768px) {
  .container {
    width: 100%;
  }
}
.text-default {
  color: #00a0e5;
}
.default-color {
  color: #00a0e5;
}
.default-color:hover {
  background-color: #00a0e5;
}
.btn-primary {
  background-color: #00a0e5;
  color: white;
  border: none;
}
.btn-primary:disabled {
  background-color: #00a0e5;
  color: white;
  border: none;
}

.btn-primary:hover {
  background-color: #00a0e5;
}

.btn-outline-primary {
  border: 1px solid #00a0e5;
}

.form-check-input {
  background-color: #e0dfdf;
}

.form-check-input:checked {
  background-color: #00a0e5;
  border-color: #00a0e5;
}
</style>
