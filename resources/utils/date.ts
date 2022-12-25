import relativeTime from 'dayjs/plugin/relativeTime'
import { ref } from 'vue'
import dayjs from 'dayjs'

/** --------------------------------------------
 * Formats a laravel date and returns it in the
 * `days ago` format
 *  - EG: (Posted: 12 minutes ago)
 *
 * @param value
 *
 * @returns {string}
 */
export const daysAgo = (value: string) => {
  dayjs.extend(relativeTime)
  return dayjs(value).fromNow()
}

/** --------------------------------------------
 * Return a formatted date
 *
 * @param value
 * @param format
 *
 * @returns {string}
 */
export const formatDate = (value: string, format: string | null = null) =>
  dayjs(value).format(format ?? 'MM-DD-YYYY hh:mm A')

/** --------------------------------------------
 * Return the current year
 *
 * @returns {number}
 */
export const currentYear = (): number => new Date().getFullYear()

/** --------------------------------------------
 * Return the current year
 *
 * @returns {number}
 */
export const now = formatDate(new Date().toString(), 'hh:mm A')

/** --------------------------------------------
 * Compare two dates
 *
 * @param dateOne
 * @param dateTwo
 */
export const compare = (
  dateOne: string | number,
  dateTwo: string | number
): boolean => dateOne > dateTwo
