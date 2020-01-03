<template>
  <div>
    <div class="episode-module d-flex br-4 mb-30 fade-in" v-for="podcast in podcasts" :key="podcasts.id">
        <div class="pr-20">
            <img :src="podcast.image" class="ew-100 card-img" alt="...">
        </div>
        <div class="flex-grow-1 align-self-center">
            <h6 class="text-uppercase c-gray-1 medium mb-15">{{ podcast.created_by }}</h6>
            <router-link :to="'/'+podcast.id+'/'+podcast.title"><h5 class="medium mb-15 c-white">{{podcast.title}}</h5></router-link>
        </div>
        <div class="align-self-top pl-20">
          <div class="votes text-center">
              <button class="vote btn btn-transparent bg-brand icon-wrap" v-b-modal.register-modal>
                <svg class="push-button" width="12" height="42" viewBox="0 0 9 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3.99984 0L-0.00015655 17.1C-0.100157 17.3 0.199843 17.5 0.399843 17.4L2.39984 16.2C2.89984 15.9 3.49984 16.2 3.49984 16.8L3.89984 27.4C3.89984 27.5 3.99984 27.5 3.99984 27.4L8.09984 10.2C8.19984 10 7.89984 9.8 7.69984 9.9L5.69984 11.1C5.19984 11.4 4.59984 11.1 4.59984 10.5L3.99984 0C3.99984 0 4.09984 0 3.99984 0Z" fill="#6F7C91"/>
                </svg>
                <h6 class="medium mt-10 c-white">{{podcast.vote_count}}</h6>
                <!-- <h6 class="vote-increment c-white">10</h6> -->
              </button>
          </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mb-3" v-if="isLoading">
      <b-spinner variant="primary" label="Loading..."></b-spinner>
    </div>
  </div>
</template>

<script>
  //
  // import axios from 'axios'
  //
  // export default {
  //     name: "Podcast",
  //     components: {
  //     },
  //     data: function () {
  //       return {
  //         resources: [],
  //         loading: true,
  //       }
  //     },
  //     mounted() {
  //       this.getPodcasts();
  //     },
  //     methods: {
  //       getPodcasts() {
  //         var self = this;
  //         axios.get("http://bitcoinersbest.local:9111/v1/items?access-token=admin-bandit-authkey&V1ResItemSearch[res_type_id]=20")
  //         .then(function(response){
  //           self.resources = response.data;
  //         })
  //         .catch(error => {
  //           console.log(error);
  //         })
  //         .finally(() => this.loading = false);
  //       }
  //     }
  // }
</script>



<script>
// todo:
// implement voting system
// bug:
// infinite scroll repeatedly calls the last segment of resource elements

// import ArticleItem from "./ArticleItem.vue";
import axios from "axios";

export default {
	name: "PodcastList",
  data() {
		return {
			endOfTheScreen: false,
			isLoading: false,
			pageNo: 1,
			limit: 10,
			podcasts: [],
			showbtn: false,
			autoLoading: true,
      user_id: 69,
		}
	},
	watch: {
		endOfTheScreen(endOfTheScreen) {
			if (endOfTheScreen === true && this.autoLoading) {
				this.pageNo += 1;
				this.loadPodcasts(this.pageNo, this.limit);
				console.log("hit end of scroll");
			}
		}
	},
	created() {
    // this.getVotes();

		window.onscroll = () => {
			this.endOfTheScreen = this.scrollCheck();
		};
		this.loadPodcasts();
	},
	methods: {
		scrollCheck() {
			if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
				return true;
			}
		},
		loadPodcasts(page = this.pageNo, limit = this.limit) {
			this.isLoading = true;
			const _self = this;
			axios.get("http://bitcoinersbest.local:9111/v1/items?access-token=admin-bandit-authkey&V1ResItemSearch[res_type_id]=20&page=" + page + "&limit=" + limit)
      .then(response => {

      const resourceList = response.data.map(c => {
          return {
            id: c.id,
            votes:
              // todo:
              // determine if logged_in, then get user_id -- hardcoded atm
               axios.get("http://bitcoinersbest.local:9111/v1/items/"+c.id+"/votes/69?access-token=admin-bandit-authkey")
              .then(res => {
                  console.log("success");
                  statusType: res.statusType
              })
          };
        })

        for (let i in response.data) {
          _self.podcasts.push(response.data[i]);
        }
        _self.isLoading = true;
        _self.showbtn = false;

			})
      .finally(() => _self.isLoading = false);
		},



    upVote(id, count) {
      var self = this;
      let config = {
        headers : {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      }

      var formData = new FormData();
      formData.append("res_item_id", id);
      formData.append("count", count);
      formData.append("user_id", 69);  // hardcoded user_id, update when twitter auth
      console.log(formData);
      console.log(id);

      axios.post('http://bitcoinersbest.local:9111/v1/res-votes?access-token=admin-bandit-authkey', formData, config)
      .then((response) => {
        this.incrementVote();
      })
      .catch(error => {
        console.log(error.response);
      });
    },
    incrementVote() {
      console.log("vote count: " +this.vote_count);
      this.resource.vote_count++;
      console.log("vote count: " +this.vote_count);
    },





	}
}
</script>

<style>
</style>
