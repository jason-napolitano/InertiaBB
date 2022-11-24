import relativeTime from 'dayjs/plugin/relativeTime'
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
  dayjs(value).format(format ?? 'dddd MMM DD, YYYY hh:mm A')

/** --------------------------------------------
 * Return the current year as a computed value
 *
 * @returns {number}
 */
export const currentYear = () => new Date().getFullYear()
