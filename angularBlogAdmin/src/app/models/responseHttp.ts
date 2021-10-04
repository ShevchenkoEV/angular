export interface ResponseHttp{
    status: boolean,
    errors: {
        message?: string
    },
    data: {
        items: any[],
        item?: any,
        request?: any,
        message?: string,
        id?: number,
        number?: number,
        exist?: boolean
    }
}