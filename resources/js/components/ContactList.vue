<template>
  <div class="contacts-list">
    <ul>
      <li
        v-for="(contact, i) in contacts"
        :key="i"
        @click="selectContact(i, contact)"
        :class="{ 'selected': i == selected }"
      >
        <div class="avatar"><img :src="contact.avatar" alt=""/></div> 
        <div class="contact">
            <p class="name">{{ contact.name }}</p>
            <p class="email">{{ contact.email }}</p>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    contacts: {
      type: Array,
      default: [],
    },
  },
  data(){
      return {
          selected: 0,
      }
  },
  methods:{
      selectContact(i, contact){
          this.selected = i;
          this.$emit('selected', contact);
      }
  }
};
</script>

<style lang="scss" scoped>
.contacts-list {
    flex: 2;
    max-height: 100%;
    height: 600px;
    overflow-y: scroll;
    border-left: 1px solid #999999;
    
    ul {
        list-style-type: none;
        padding-left: 0;
        li {
            display: flex;
            padding: 2px;
            border-bottom: 1px solid #999999;
            height: 80px;
            position: relative;
            cursor: pointer;
            &.selected {
                background:#f2f2f2;
            }
            span.unread {
                background: #82e0a8;
                color: #fff;
                position: absolute;
                right: 11px;
                top: 20px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 3px;
            }
            .avatar {
                flex: 1;
                display: flex;
                align-items: center;
                img {
                    width: 35px;
                    border-radius: 50%;
                    margin: 0 auto;
                }
            }
            .contact {
                flex: 3;
                font-size: 10px;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                justify-content: center;
                p {
                    margin: 0;
                    &.name {
                        font-weight: bold;
                    }
                }
            }
        }
    }
}
</style>