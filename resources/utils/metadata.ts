import { toTitleCase, ucFirst } from '@/utils/string'
import { implode } from '@/utils/array'

export const title = (value: string): string => toTitleCase(value)
export const keywords = (array: string[]): string => implode(array)
export const description = (string: string): string => ucFirst(string)
