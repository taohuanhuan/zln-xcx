const http = uni.$u.http

// post请求，获取菜单
export const wxLogin = params => http.post('wx/login', params)

export const postReminder = params => http.post('reminder/save', params)
export const todayList = params => http.get('reminder/todayList', params)
export const reminderMark = params => http.post('reminder/mark', params)
export const reminderCreate = params => http.post('reminder/create', params)


export const getMainPageInfo = (params) => http.post('/resident/getMainPageInfo', params)
//banner


export const pushSchedule = params => http.post('push/schedule', params)

//经期
export const MenstrualSave = params => http.post('Menstrual/save', params)
export const MenstrualList = params => http.post('Menstrual/list', params)