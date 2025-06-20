const http = uni.$u.http

export const wxLogin = params => http.post('wx/login', params)

export const postReminder = params => http.post('reminder/save', params)
export const todayList = params => http.get('reminder/todayList', params)
export const reminderMark = params => http.post('reminder/mark', params)
export const reminderCreate = params => http.post('reminder/create', params)

export const pushSchedule = params => http.post('push/schedule', params)

// 经期
export const MenstrualSave = params => http.post('Menstrual/save', params)
export const MenstrualList = params => http.post('Menstrual/list', params)

// 用户资料
export const getProfileOptions = () => http.get('messages/options')
export const getProfileInfo = () => http.get('messages/info')
export const saveProfileInfo = params => http.post('messages/save', params)

// 徽章相关
export const getBadgeList = () => http.get('badge/list')
export const getMyBadges = () => http.get('badge/my')
export const claimBadge = params => http.post('badge/claim', params)

export const getUserInfo = () => http.get('user/info')
