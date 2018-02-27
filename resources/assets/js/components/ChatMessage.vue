<template lang="html">
  <div>
<p>{{ message.message }}</p>
<small><b>{{ message.user.User }}</b></small>

  </div>
</template>


<script>
export default {

props: ['message']
  
}
</script>
