<template>
    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-inline">
                        <input type="text" class="form-control mb-2 mr-sm-2" placeholder="Search..." id="search"
                               v-model="search">
                        <button type="button" class="btn btn-primary mb-2 mr-sm-2" @click="this.getCharacters">Search
                        </button>
                        <label class="mb-2 mr-sm-2" for="filter">Gender:</label>
                        <select class="form-control mb-2 mr-sm-2" v-model="filterGender" id="filter">
                            <option value="" selected>All</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <label class="mb-2 mr-sm-2 mr-sm-2" for="died">Died:</label>
                        <select class="form-control mb-2 " v-model="filterDied" id="died">
                            <option value="" selected>All</option>
                            <option value="0">Alive</option>
                            <option value="1">Died</option>
                        </select>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Culture</th>
                            <th>Born</th>
                            <th>Died</th>
                            <th>Titles</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="character in activeCharacters">
                            <td>{{character.id}}</td>
                            <td>{{character.name}}</td>
                            <td>{{character.gender}}</td>
                            <td>{{character.culture}}</td>
                            <td>{{character.born}}</td>
                            <td>{{character.died}}</td>
                            <td>
                                <ul class="list-unstyled">
                                    <li v-for="title in JSON.parse(character.titles)">
                                        {{title}}
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <router-link :to="{path: '/character/' + character.id}">Details</router-link>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <pagination :data="charactersData" @pagination-change-page="getCharacters">
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                    </pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                search: null,
                filterGender: null,
                filterDied: null,
                charactersData: {},
                characters: []
            }
        },
        mounted() {
            this.getCharacters()
        },
        computed: {
            activeCharacters: function () {
                return this.characters.filter(function (c) {
                    return !c.name.startsWith('B') && !c.name.startsWith('D') && !c.name.startsWith('Q');
                })
            }
        },
        watch: {
            filterGender() {
                this.getCharacters();
            },
            filterDied() {
                this.getCharacters();
            }
        },
        methods: {
            getCharacters: function (page = 1) {
                axios.get('/api/characters', {
                    params: {
                        page: page,
                        search: this.search,
                        gender: this.filterGender,
                        died: this.filterDied
                    }
                })
                    .then(response => {
                        this.charactersData = response.data;
                        this.characters = response.data.data;
                    });
            }
        }
    }
</script>
