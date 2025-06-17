<template>
	<view>
		<van-collapse v-model="activeNames">
		  <van-collapse-item title="标题1" name="1">这是常见问题1的标题占位符</van-collapse-item>
		  <van-collapse-item title="标题2" name="2">这是常见问题1的标题占位符</van-collapse-item>
		  <van-collapse-item title="标题3" name="3">这是常见问题1的标题占位符</van-collapse-item>
		</van-collapse>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				activeNames: ['1'],
			};
		},
		methods:{
			onChange(event) {
			    this.setData({
			      activeNames: event.detail,
			    });
			  },
		}
	}
</script>

<style lang="scss">

</style>
