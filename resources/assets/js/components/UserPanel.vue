<template>
<div class="uk-width-1-5@m">
  <ul class="uk-grid-small uk-flex-middle" uk-grid>
    <li>
      <a class="uk-icon-button" uk-icon="icon: user" :href="profileLink">
        
      </a>
    </li>
    <li>
      <a class="uk-icon-button" uk-icon="icon: heart" :href="wishlistLink"></a>
        <div class="uk-badge custom-badge">
        </div>             
    </li>
    <li>
      <a class="uk-icon-button" uk-icon="icon: cart" :href="bagLink"></a>
        <div class="uk-badge custom-badge">
        </div>
    </li>
  </ul>

</div>
</template>

<script>
    export default {
      props: ['profile_link', 'wishlist_link', 'bag_link'],
      data() {
            return {
                profileLink: this.profile_link,
                wishlistLink: this.wishlist_link,
                bagLink: this.bag_link
            }
        }
    }
</script>