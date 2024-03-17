import {isObject} from './object'

export function dateWithTz(date, tzString)
{
    return new Date((typeof date === "string" ? new Date(date) : date).toLocaleString("en-US", {timeZone: tzString}));
}

/**
 * Creates a query string from given params
 * @param  {Object}  queryObj query params to stringify
 * @param  {String}  prefix   parent name (for recursive calls)
 * @param  {Array}   str      already built uri components (for recursive calls)
 * @param  {Boolean} isArray  add name in brackets or not (for recursive calls)
 *
 * @return {String}          stringified query
 *
 * @example
 * // returns space=with%20space&obj%5Bnumber%5D=123&obj%5Barray%5D%5B%5D=1&obj%5Barray%5D%5B%5D=2&obj%5Barray%5D%5B%5D=3
 * // with decodeURIComponents you'll get space=with space&obj[number]=123&obj[array][]=1&obj[array][]=2&obj[array][]=3
 *
 * stringifyQuery({
 *    space: "with space",
 *    obj: {
 *       number: 123,
 *       array: [1, 2, 3]
 *    }
 * })
 *
 */
export function stringifyQuery(queryObj, prefix, str = [], isArray)
{
    for (let param in queryObj) {
        // include only own properties
        if (queryObj.hasOwnProperty(param)) {
            // TODO: fix param.replace(/\[\]$/, ''), which is quick patch
            let _key = prefix
                ? prefix + "[" + (isArray ? "" : param) + "]"
                : /* param */ param.replace(/\[\]$/, ""),
                _val = queryObj[param];

            if (isObject(_val)) {
                stringifyQuery(_val, _key, str, Array.isArray(_val));
            } else {
                str.push(
                    encodeURIComponent(_key) + "=" + encodeURIComponent(_val)
                );
            }
        }
    }

    return str.join("&");
}

export function getQueryParam(key, uri)
{
    if (!uri) {
        uri = document.location.href;
    }

    const url = new URL(uri);
    const params = url.searchParams;

    return params.get(key);
}

export function setParamToQuery(key, value, uri)
{
    if (!uri) {
        uri = document.location.href;
    }

    const url = new URL(uri);
    url.searchParams.set(key, value);

    return url.toString();
}

export function appendParamToQuery(key, value, uri)
{
    if (!uri) {
        uri = document.location.href;
    }

    const url = new URL(uri);
    url.searchParams.append(key, value);

    return url.toString();
}
