<template>
	<view class="main">
		<view class="container">
			<u-collapse @change="change" @close="close" @open="open">
				<u-collapse-item title="这是常见问题分类标题" name="Docs guide">
					<text class="u-collapse-content" @click="navPage('/guanlishi/mine/wentixiangqing')">这是常见问题1的标题占位符</text>
				</u-collapse-item>
			</u-collapse>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {

			};
		},
		methods:{
			navPage(url){
				uni.navigateTo({
					url
				})
			}
		}
	}
</script>

<style lang="scss" scoped>
	.main{
		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;
	}
	.container{
		background-color: white;
	}
</style>