<template>
  <div>
    <h2>Articles</h2>

    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li
          v-bind:class="[{ disabled: !pagination.prev_page_url }]"
          class="page-item"
        >
          <a
            @click="fetchArticles(pagination.prev_page_url)"
            class="page-link"
            href="#"
            >Previous</a
          >
        </li>

        <li class="page-item disabled">
          <a class="page-link text-dark" href="#"
            >Page {{ pagination.current_page }} of {{ pagination.last_page }}</a
          >
        </li>

        <li
          class="page-item"
          v-bind:class="[{ disabled: !pagination.next_page_url }]"
        >
          <a
            @click="fetchArticles(pagination.next_page_url)"
            class="page-link"
            href="#"
            >Next</a
          >
        </li>
      </ul>
    </nav>

    {{ pagination }}

    <div
      class="card card-body mb-2"
      v-for="article in articles"
      v-bind:key="article.id"
    >
      <h3>{{ article.title }}</h3>
      <p>{{ article.body }}</p>
      <button @click="deleteArticle(article.id)" class="btn btn-danger">Delete</button>
    </div>

    <hr />
  </div>
</template>

<script>

export default {
  data() {
    return {
      articles: [],
      article: {
        id: "",
        title: "",
        body: "",
      },
      article_id: "",
      pagination: {},
      edit: false,
    };
  },
  created() {
    this.fetchArticles();
  },
  methods: {
    fetchArticles(page_url) {
      let vm = this;
      page_url = page_url || "/api/articles";
      fetch(page_url)
        .then((res) => res.json())
        .then(({ data, meta, links }) => {
          this.articles = data;
          vm.makePagination(meta, links);
        })
        .catch((err) => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev,
      };

      this.pagination = pagination;
    },

    deleteArticle(id) {
      if (confirm("Are you sure?")) {
        fetch(`api/articles/${id}`, {
          method: "delete",
        })
          .then((res) => res.json)
          .then((data) => {
            alert("Artivle removed");
            this.fetchArticles();
          })
          .catch((err) => console.log(err));
      }
    },
  },
};
</script>