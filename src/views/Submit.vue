<template>
  <div>
  <section class="submit-resource mt-50 fade-in">
     <div class="section-header pb-20 text-center">
       <h1 class="mb-0 c-white">Submit<span class="mobile-hide"> your bitcoin</span> resource</h1>
       <p class="mt-10 c-gray-1">Your submission will be reviewed before it appears live.</p>
     </div>

<b-form @submit.prevent="addResource" @reset="resetForm" id="submit-resource">
  <b-row>
  <b-col cols="12">
   <label class="c-white mb-20">Pick your resource type: </label>
    <!-- <b-form-select v-model="selected" :options="options" class="submit-resouce-selector mb-30" @change="onSelectChange()"></b-form-select> -->
      <select class="form-control" v-model="selected">
        <option value="Select Resource" selected disabled>Select Resource</option>
        <option v-for="o in options" v-bind:value="o">{{o.text}}</option>
      </select>
  </b-col>
 </b-row>
  <div v-if="selected.value === '20'">
    <b-row>
      <b-col cols="8">

        <b-form-group id="input-podcast-url" label="Podcast URL" label-for="input-podcast-url">
         <b-form-input
           id="input-podcast-url"
           v-model="Podcast.url"
           required
           placeholder="Podcast URL"
         ></b-form-input>
       </b-form-group>

        <b-form-group id="input-podcast-title" label="Podcast Title" label-for="input-podcast-title">
         <b-form-input
           id="input-podcast-title"
           v-model="Podcast.title"
           required
           placeholder="Podcast Title"
         ></b-form-input>
       </b-form-group>

       <b-form-group id="input-podcast-description" label="Podcast Description" label-for="input-podcast-description">
         <b-form-textarea
           id="input-podcast-description"
           v-model="Podcast.description"
           placeholder="Description..."
           rows="4"
           max-rows="6"
         ></b-form-textarea>
       </b-form-group>

        <!-- <b-form-file
          v-model="Podcast.file"
          :state="Boolean(file)"
          placeholder="Choose a file or drop it here..."
          drop-placeholder="Drop file here..."
          accept=".jpg, .jpeg, .png"
          @change="onFileChange
         "></b-form-file>
        <div class="mt-3">Selected file: {{ file ? file.name : '' }}</div> -->


          <div v-if="!Podcast.image">
            <h2>Select an image</h2>
            <input type="file" @change="onFileChange">
          </div>
          <div v-else>
            <div id="preview">
              <img :src="Podcast.image" />
              <button @click="removeImage">Remove image</button>
            </div>
          </div>

         <b-form-group id="input-podcast-created-by" label="Created by" label-for="input-podcast-created-by">
          <b-form-input
            id="input-podcast-created-by"
            v-model="Podcast.created_by"
            required
            placeholder="Created by"
          ></b-form-input>
         </b-form-group>

         <b-form-group id="input-podcast-rss" label="Podcast RSS" label-for="input-podcast-rss">
          <b-form-input
            id="input-podcast-rss"
            v-model="Podcast.rss"
            required
            placeholder="Podcast RSS"
          ></b-form-input>
         </b-form-group>


        <!-- <b-form-group id="input-podcast-image" label="Podcast Image" label-for="input-podcast-image">
         <b-form-input
           id="input-podcast-image"
           v-model="Podcast.image"
           required
           placeholder="Podcast Image"
         ></b-form-input>
        </b-form-group> -->

       <b-button type="submit" class="btn btn-rect-lg push-button">Submit</b-button>

      </b-col>
      <b-col cols="4 preview">

        <b-card class="mt-3" header="Podcast Data Result">
          <pre class="m-0">{{ Podcast }}</pre>
        </b-card>

        <div class="mt-2 c-white">
          <div id="preview">
              <img v-if="Podcast.image" :src="Podcast.image" />
          </div>
        </div>
        <div class="mt-2 c-white">{{ Podcast.image }}</div>
        <div class="mt-2 c-white">{{ Podcast.title }}</div>
        <div class="mt-2 c-white">{{ Podcast.description }}</div>
      </b-col>
   </b-row>

  </div>

  <div v-if="selected.value === '25'">
    <b-row>
    <b-col cols="8">

      <b-form-group id="input-episode-title" label="Episode Title" label-for="input-episode-title">
       <b-form-input
         id="input-episode-title"
         v-model="Episode.title"
         required
         placeholder="Episode Title"
       ></b-form-input>
      </b-form-group>

      <b-form-group id="input-episode-created-by" label="Created by" label-for="input-episode-created-by">
       <b-form-input
         id="input-episode-created-by"
         v-model="Episode.created_by"
         required
         placeholder="Created by"
       ></b-form-input>
      </b-form-group>

      <!-- <p class="mb-20 c-white">Podcast Dropdown Select of Added Podcasts OR</p> -->
      <b-form-group id="input-episode-podcast" label="Episode Podcast" label-for="input-episode-podcast">
       <b-form-input
         id="input-episode-podcast"
         v-model="Episode.podcast"
         required
         placeholder="Episode Podcast"
       ></b-form-input>
       </b-form-group>

       <!-- <b-form-group id="input-podcast-image" label="Podcast Image" label-for="input-podcast-image">
        <b-form-input
          id="input-podcast-image"
          v-model="Episode.image"
          required
          placeholder="Podcast Image"
        ></b-form-input>
        </b-form-group> -->

        <div v-if="!Episode.image">
          <h2>Select an image</h2>
          <input type="file" @change="onFileChange">
        </div>
        <div v-else>
          <div id="preview">
            <img :src="Episode.image" />
            <button @click="removeImage">Remove image</button>
          </div>
        </div>

        <b-form-group id="input-episode-url" label="Episode URL" label-for="input-episode-url">
         <b-form-input
           id="input-episode-url"
           v-model="Episode.url"
           required
           placeholder="Podcast URL"
         ></b-form-input>
         </b-form-group>

         <b-button type="submit" class="btn btn-rect-lg push-button">Submit</b-button>

    </b-col>

    <b-col cols="4 preview">

      <b-card class="mt-3" header="Episode Data Result">
        <pre class="m-0">{{ Episode }}</pre>
      </b-card>

      <div class="mt-2 c-white">{{ Episode.image }}</div>
      <div class="mt-2 c-white">{{ Episode.created_by }}</div>
      <div class="mt-2 c-white">{{ Episode.title }}</div>
    </b-col>
  </b-row>

  </div>


  <div v-if="selected.value === '30'">
    <b-row>
      <b-col cols="8">

        <b-form-group id="input-article-url" label="Article URL" label-for="input-article-url">
         <b-form-input
           id="input-article-url"
           v-model="Article.url"
           required
           placeholder="Article URL"
         ></b-form-input>
        </b-form-group>

        <b-form-group id="input-article-created-by" label="Created by" label-for="input-article-created-by">
         <b-form-input
           id="input-article-created-by"
           v-model="Article.created_by"
           required
           placeholder="Created by"
         ></b-form-input>
        </b-form-group>

       <!-- <b-form-group id="input-article-image" label="Article Image" label-for="input-article-image">
        <b-form-input
          id="input-article-image"
          v-model="Article.image"
          required
          placeholder="Article Image"
        ></b-form-input>
       </b-form-group> -->

       <div v-if="!Article.image">
         <h2>Select an image</h2>
         <input type="file" @change="onFileChange">
       </div>
       <div v-else>
         <div id="preview">
           <img :src="Article.image" />
           <button @click="removeImage">Remove image</button>
         </div>
       </div>

     <b-form-group id="input-article-title" label="Article Title" label-for="input-article-title">
      <b-form-input
        id="input-article-title"
        v-model="Article.title"
        required
        placeholder="Article Title"
      ></b-form-input>
     </b-form-group>


      <b-form-group id="input-article-description" label="Article Description" label-for="input-article-description">
        <b-form-textarea
          id="input-article-description"
          v-model="Article.description"
          placeholder="Description..."
          rows="4"
          max-rows="6"
        ></b-form-textarea>
      </b-form-group>

     <b-button type="submit" class="btn btn-rect-lg push-button">Submit</b-button>

     </b-col>
     <b-col cols="4 preview">

       <b-card class="mt-3" header="Article Data Result">
         <pre class="m-0">{{ Article }}</pre>
       </b-card>

       <div class="mt-2 c-white">
         <div id="preview">
             <img v-if="Article.image" :src="Article.image" />
         </div>
       </div>
      <div class="mt-2 c-white">{{ Article.image }}</div>
      <div class="mt-2 c-white">{{ Article.title }}</div>
      <div class="mt-2 c-white">{{ Article.description }}</div>
     </b-col>
   </b-row>

  </div>


  <div v-if="selected.value === '35'">
    <b-row>
      <b-col cols="8">

        <b-form-group id="input-book-title" label="Book Title" label-for="input-book-title">
         <b-form-input
           id="input-book-title"
           v-model="Book.title"
           required
           placeholder="Book Title"
         ></b-form-input>
        </b-form-group>

        <b-form-group id="input-book-created-by" label="Created by" label-for="input-book-created-by">
         <b-form-input
           id="input-book-created-by"
           v-model="Book.created_by"
           required
           placeholder="Created by"
         ></b-form-input>
        </b-form-group>

        <!-- <b-form-group id="input-book-image" label="Book Image" label-for="input-book-image">
         <b-form-input
           id="input-book-image"
           v-model="Book.image"
           required
           placeholder="Book Image"
         ></b-form-input>
        </b-form-group> -->

        <div v-if="!Book.image">
          <h2>Select an image</h2>
          <input type="file" @change="onFileChange">
        </div>
        <div v-else>
          <div id="preview">
            <img :src="Book.image" />
            <button @click="removeImage">Remove image</button>
          </div>
        </div>


        <b-form-group id="input-book-url" label="Book URL" label-for="input-book-url">
         <b-form-input
           id="input-book-url"
           v-model="Book.url"
           required
           placeholder="Book URL"
         ></b-form-input>
        </b-form-group>

        <b-button type="submit" class="btn btn-rect-lg push-button">Submit</b-button>

      </b-col>

      <b-col cols="4 preview">

        <b-card class="mt-3" header="Book Data Result">
          <pre class="m-0">{{ Book }}</pre>
        </b-card>

        <div class="mt-2 c-white">{{ Book.image }}</div>
        <div class="mt-2 c-white">{{ Book.title }}</div>
        <div class="mt-2 c-white">{{ Book.description }}</div>
      </b-col>
  </b-row>

  </div>


   <div v-if="selected.value === '40'">

     <b-col cols="4 preview">

     </b-col>

   </div>

</b-form>

      <div class="c-white" v-if="submitting">Submitting...</div>
      <b-alert show dismissible v-if="resourceSubmitted" class="alert mt-20">
        Success!
      </b-alert>


   </section>
 </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      url: null,
      Podcast: {
        id: '',
        title: '',
        description: '',
        image: '',
        rss: '',
        url: '',
        created_by: '',
        res_type_id: '20', // todo: dynamically generate
      },
      Episode: {
        id: '',
        title: '',
        image: '',
        _image: '',
        url: '',
        rss: 'null',
        created_by: '',
        res_type_id: '25',
      },
      Article: {
        id: '',
        title: '',
        description: '',
        image: '',
        rss: '',
        url: '',
        created_by: '',
        res_type_id: '30',
      },
      Book: {
        id: '',
        title: '',
        image: '',
        url: '',
        created_by: '',
        res_type_id: '35',
      },
      Thread: {
        id: '',
        text: '',
        description: '',
        profile_image: '',
        url: '',
        created_by: '',
        res_type_id: '40',
      },
      submitting: false,
      resourceSubmitted: false,

      // options for dropdown selection
      selected: '20',
      options: [
        { value: '20', text: 'Podcast' },
        { value: '25', text: 'Episode' },
        { value: '30', text: 'Article' },
        { value: '35', text: 'Book' },
        { value: '40', text: 'Thread' }
      ]
    }
  },

  methods: {
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length)
        return;
      this.createImage(files[0]);
    },
    createImage(file) {
      if (this.selected.value == "20") {
        this.Podcast.image = new Image();
      } else if (this.selected.value == "25") {
        this.Episode.image = new Image();
      } else if (this.selected.value == "30") {
        this.Article.image = new Image();
      }
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        if (this.selected.value == "20") {
          vm.Podcast.image = e.target.result;
        } else if (this.selected.value == "25") {
          vm.Episode.image = e.target.result;
        } else if (this.selected.value == "30") {
          vm.Article.image = e.target.result;
        }
      };
      reader.readAsDataURL(file);
      console.log(file);
    },
    removeImage: function (e) {
      if (this.selected.value == "20") {
        this.Podcast.image = '';
      } else if (this.selected.value == "25") {
        this.Episode.image = '';
      } else if (this.selected.value == "30") {
        this.Article.image = '';
      }
    },
    addResource(evt) {
      var self = this;
      evt.preventDefault();
      self.submitting = true;

      let config = {
        headers : {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      }

      var formData = new FormData();
      if (this.selected.value == "20") {
        formData.append("title", self.Podcast.title);
        formData.append("description", self.Podcast.description);
        formData.append("image", this.Podcast.image);
        formData.append("rss", self.Podcast.rss);
        formData.append("created_by", self.Podcast.created_by);
        formData.append("res_type_id", this.selected.value);
        formData.append("url", self.Podcast.url);
      } else if (this.selected.value == "25") {
        formData.append("title", self.Episode.title);
        formData.append("description", self.Episode.description);
        formData.append("image", self.Episode.image);
        formData.append("created_by", self.Episode.created_by);
        formData.append("res_type_id", this.selected.value);
        formData.append("url", self.Episode.url);
        formData.append("rss", this.Episode.rss);
      } else if (this.selected.value == "30") {
        formData.append("title", self.Article.title);
        formData.append("description", self.Article.description);
        formData.append("image", this.Article.image);
        formData.append("created_by", self.Article.created_by);
        formData.append("res_type_id", this.selected.value);
        formData.append("url", self.Article.url);
      } else if (this.selected.value == "35") {
        formData.append("title", self.Book.title);
        formData.append("image", self.Book.image);
        formData.append("created_by", self.Book.created_by);
        formData.append("res_type_id", this.selected.value);
        formData.append("url", self.Book.url);
      }

      axios.post('http://bitcoinersbest.local:9111/v1/items?access-token=admin-bandit-authkey', formData, config)
      .then((response) => {
        console.log(response.data);
        self.submitting = false;
        self.resourceSubmitted = true;

        this.resetForm(this.selected);
      })
      .catch(error => {
        console.log(error);
      });

    },
    // todo:
    // reduce this
    resetForm(selected) {
      if (selected.value == "20") {
        this.Podcast.title = '';
        this.Podcast.description = '';
        this.Podcast.image = '';
        this.Podcast.url = '';
        this.Podcast.created_by = '';
        this.Podcast.rss = '';
      } else if (selected.value == "25") {
        this.Episode.title = '';
        this.Episode.description = '';
        this.Episode.image = '';
        this.Episode.url = '';
        this.Episode.created_by = '';
      } else if (selected.value == "30") {
        this.Article.title = '';
        this.Article.description = '';
        this.Article.image = '';
        this.Article.url = '';
        this.Article.created_by = '';
      } else if (selected.value == "35") {
        this.Book.title = '';
        this.Book.image = '';
        this.Book.url = '';
        this.Book.created_by = '';
      } else if (selected.value == "40") {

      }
    }
  }
}
</script>

<style>

.custom-select {
  display: inline-block;
  width: 100%;
  height: 80px !important;
  padding: 20px !important;
  font-size: 24px !important;
  font-weight: 400;
  line-height: 1.5;
  color: #fff;
  vertical-align: middle;
  background: #425164;
  background: #425164 url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' heig…0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e) no-repeat right 0.75rem center/8px 10px;
  border: transparent;
  border-radius: 0.25rem;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  padding: 20px;
}

#preview {
  display: flex;
  justify-content: center;
  align-items: center;
}

#preview img {
  max-width: 100%;
  max-height: 500px;
}


</style>



/* {
 title: this.title,
 description: this.description,
 image: this.image,
 url: this.url,
 res_type_id: 20
} */
