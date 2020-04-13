<template>
    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" v-model="character.name">
                    </div>
                    <div class="form-group">
                        <label for="name">Gender:</label>
                        <input type="text" class="form-control" id="gender" v-model="character.gender">
                    </div>
                    <div class="form-group">
                        <label for="name">Culture:</label>
                        <input type="text" class="form-control" id="culture" v-model="character.culture">
                    </div>
                    <div class="form-group">
                        <label for="name">Born:</label>
                        <input type="text" class="form-control" id="born" v-model="character.born">
                    </div>
                    <div class="form-group">
                        <label for="name">Died:</label>
                        <input type="text" class="form-control" id="died" v-model="character.died">
                    </div>
                    <button type="submit" class="btn btn-primary" @click="this.updateCharacter">Update</button>
                </div>
                <div class="col-md-6">
                    <div class="form-group" v-if="titles[0] != ''">
                        <label for="titles">Titles:</label>
                        <ul id="titles">
                            <li v-for="title in titles">
                                {{title}}
                            </li>
                        </ul>
                    </div>
                    <div class="form-group" v-if="aliases[0] != ''">
                        <label for="aliases">Aliases:</label>
                        <ul id="aliases">
                            <li v-for="alias in aliases">
                                {{alias}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                character: [],
                titles: [],
                aliases: []
            }
        },
        mounted() {
            this.getCharacter()
        },
        methods: {
            getCharacter: function () {
                axios.get('/api/characters/' + this.$route.params.id).then((response) => {
                    this.character = response.data;
                    this.titles = JSON.parse(response.data.titles);
                    this.aliases = JSON.parse(response.data.aliases);
                    console.log(response.data);
                })

            },
            updateCharacter: function () {
                axios.put('/api/characters/' + this.$route.params.id, {
                    name: this.character.name,
                    gender: this.character.gender,
                    culture: this.character.culture,
                    born: this.character.born,
                    died: this.character.died,
                }).then((response) => {
                    this.$notify({
                        group: 'foo',
                        type: response.data.type,
                        title: response.data.title,
                        text: response.data.message
                    });
                    this.character = response.data.data;
                }).catch(e => {
                    this.$notify({
                        group: 'foo',
                        type: 'error',
                        title: 'Error',
                        text: e.response.data.message
                    });
                })
            }
        }
    }
</script>
