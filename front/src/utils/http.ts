import axios, { AxiosRequestConfig, AxiosResponse } from 'axios'

const url = import.meta.env.VITE_API_URL

const api = axios.create({
  baseURL: url,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
})

api.interceptors.response.use(
  (response) => response,
  (error) => Promise.reject(throwError(error))
)

function throwError (e: Error | any) {
  const { response } = e

  if (e.code === 'ERR_NETWORK') {
    throw new Error('Falha na comunicação com o servidor')
  }

  throw new Error(response.data.message)
}

export async function post (url: string, data: any, config: AxiosRequestConfig = {}): Promise<{
  user: Pick<AxiosResponse, 'data'>,
  token: string
}> {
  const response = await api.post(url, data, config)

  return response.data
}

export async function put<Response> (url: string, data: any, config: AxiosRequestConfig = {}): Promise<Response | undefined> {
  try {
    const response = await api.put(url, data, config)

    return (response.data) as Response
  } catch (e: Error | any) {
    throwError(e)
  }
}

export async function get<Response> (url: string, config: AxiosRequestConfig = {}): Promise<Response | undefined> {
  try {
    const response = await api.get(url, config)

    return (response.data) as Response
  } catch (e: Error | any) {
    throwError(e)
  }
}