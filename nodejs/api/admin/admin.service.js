const pool = require("../../config/database");

module.exports = {
    create: (data, callBack) => {
        pool.query(
            'INSERT INTO admin (name, email, password) VALUES (?, ?, ?)',
            [data.name, data.email, data.password],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results);
            }
        );
    },

    getUserByPhone: (email, callBack) => {
        pool.query(
            'SELECT * FROM admin WHERE email = ?',
            [email],
            (error, results) => {
                if (error) {
                    return callBack(error);
                }
                return callBack(null, results[0]);
            }
        );
    },

deleteItem: (data, callBack) => {
    const tableMap = {
        audios: 'audios',
        quotes: 'quotes',
        featured: 'featured',
        visuals: 'visual_assets'
    };

    const tableName = tableMap[data.table];
    if (!tableName) {
        return callBack(new Error('Invalid table name'));
    }

    pool.query(
        `DELETE FROM ${tableName} WHERE id = ?`,
        [data.id],
        (error, results) => {
            if (error) {
                return callBack(error);
            }
            return callBack(null, results); // or results.affectedRows
        }
    );
},



deleteKeyword: (data, callBack) => {
    const tableMap = {
        audio: 'audio_keywords',
        quote: 'quote_keywords',
        visual: 'visual_keywords'
    };

    const columnMap = {
        audio: 'audio_id',
        quote: 'quote_id',
        visual: 'visual_id'
    };

    const tableName = tableMap[data.table];
    const columnName = columnMap[data.table];

    if (!tableName) {
        return callBack(new Error('Invalid table name'));
    }

    // console.log(`Deleting from ${tableName} where ${columnName}=${data.item_id} and keyword='${data.keyword}'`); // Debug log

    pool.query(
        `DELETE FROM ${tableName} WHERE ${columnName} = ? AND keyword = ?`,
        [data.item_id, data.keyword],
        (error, results) => {
            if (error) {
                console.error('Database error:', error); // More detailed error logging
                return callBack(error);
            }
            console.log('Delete results:', results); // Debug log
            return callBack(null, results);
        }
    );
}






};
