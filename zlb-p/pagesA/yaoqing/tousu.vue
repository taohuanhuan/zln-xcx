<template>
	<view class="main">
		<view class="card">
			<view class="title">投诉/建议</view>

			<view class="upload">
				<view class="title">内容：</view>
				<u--textarea v-model="content" placeholder="请输入投诉/建议内容"></u--textarea>
			</view>

			<view class="item">
				<view class="left"><text class="required"></text>图片</view>
			</view>
			<view class="item2">
				<u-upload :fileList="fileList2" @afterRead="afterRead" @delete="deletePic" name="2" multiple
					:maxCount="9"></u-upload>
			</view>


			<view class="btn" @click="submit">提交</view>
		</view>
	</view>
</template>

<script>
	import {
		add,
		uploadFile
	} from '../../config/api'; // 上传接口和表单提交接口
	import {
		DOMAIN
	} from '@/config/config.js';
	export default {
		data() {
			return {
				content: '',
				fileList2: [], // 资质证书文件列表
				consultant_image: [], // 上传成功后存储照片文件URL
				wfil: []
			};
		},
		methods: {
			// 提交表单
			async submit() {
				
				let images = []
				
				this.fileList2.forEach(item=>{
					images.push(item.url)
				})
				
				add({
					type:1,
					feedback_content:this.content,
					feedback_file:images.join(',')
				}).then((data)=>{
					uni.navigateBack()
				})
				
			},

			// 删除图片
			deletePic(event) {
				this[`fileList${event.name}`].splice(event.index, 1);
			},

			// 读取图片并上传
			async afterRead(event) {
				let lists = [].concat(event.file);
				let fileListName = `fileList${event.name}`;
				let fileListLen = this[fileListName].length;

				// 显示上传中状态
				lists.map((item) => {
					this[fileListName].push({
						...item,
						status: 'uploading',
						message: '上传中'
					});
				});

				this.wfil = lists

				// 上传每个文件
				for (let i = 0; i < lists.length; i++) {
					const result = await this.uploadFilePromise(lists[i].url);
					let item = this[fileListName][fileListLen];
					this[fileListName].splice(fileListLen, 1, {
						...item,
						status: 'success',
						message: '',
						url: result // 上传成功后的URL
					});
					fileListLen++;
				}
			},

			// 调用上传文件接口
			async uploadFilePromise(url) {
				let response = await uploadFile({
					filePath: url,
					name: 'file[]'
				});

				return response.url;
			}
		}
	};
</script>

<style lang="scss" scoped>
	.main {
		width: 690rpx;
		padding-top: 20rpx;
		background-color: #F6F6F6;
		min-height: 100vh;
		width: 690rpx;

		.card {
			background-color: white;
			padding: 30rpx;
			box-sizing: border-box;
			border-radius: 16rpx;

			.title {
				font-weight: bold;
				font-size: 32rpx;
				color: #242424;
			}

			.item {
				height: 88rpx;
				display: flex;
				justify-content: space-between;
				border-bottom: 1px solid #F6F6F6;
				align-items: center;

				.left {
					font-weight: 400;
					font-size: 28rpx;
					color: #242424;
				}

				.right {
					input {
						text-align: right;
						font-size: 28rpx;
						color: #999999;
					}
				}

			}

			.upload {
				margin-top: 20rpx;

				.title {
					font-weight: 400;
					font-size: 28rpx;
					color: #666666;
					margin-bottom: 20rpx;
				}

				.text {
					background-color: #F6F6F6;
					border-radius: 16rpx;
					padding: 20rpx;
					box-sizing: border-box;
					height: 160rpx;
				}
			}
		}

	}

	.btn {
		position: fixed;
		bottom: 50rpx;
		width: 690rpx;
		height: 88rpx;
		background: linear-gradient(90deg, #D275F2 0%, #AE38D7 100%);
		border-radius: 44rpx;
		font-weight: bold;
		font-size: 28rpx;
		color: #FFFFFF;
		line-height: 88rpx;
		text-align: center;
	}
</style>